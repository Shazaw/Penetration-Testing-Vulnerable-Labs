#!/bin/bash

echo "Starting Legacy Vulnerable Lab setup..."
echo "This process will install multiple services and may take several minutes."

# --- Wait for any background updates to finish ---
while fuser /var/lib/dpkg/lock-frontend >/dev/null 2>&1; do
   echo "Waiting for other package manager process to finish..."
   sleep 10
done

# --- Install All Services ---
echo "  Installing required packages..."
apt-get update > /dev/null 2>&1
apt-get install -y vsftpd mariadb-server tomcat9 tomcat9-admin distcc openssh-server > /dev/null 2>&1

# --- Configure SSH to allow password login ---
echo "  Configuring SSH for password authentication..."
sed -i 's/PasswordAuthentication no/PasswordAuthentication yes/g' /etc/ssh/sshd_config
systemctl restart sshd

# --- Create Users for demos ---
echo "  Creating user accounts 'student' and 'student2'..."
useradd -m -s /bin/bash student
echo "student:P@ssw0rd" | chpasswd
useradd -m -s /bin/bash student2
echo "student2:P@ssword456" | chpasswd

# --- Configure FTP ---
echo "  Configuring anonymous FTP service from config file..."
# Copy the config file from the repository
cp ./config/vsftpd.conf /etc/vsftpd.conf
mkdir -p /var/ftp
echo "OmahTIAcademy{enum_flag_from_ftp_file}" > /var/ftp/FLAG_ENUM.txt
chown ftp:nogroup /var/ftp/*
chmod 644 /var/ftp/*
systemctl restart vsftpd

# --- Configure MySQL ---
echo "Configuring vulnerable MySQL database..."
systemctl start mariadb
mysql -e "CREATE DATABASE secrets;"
mysql -e "USE secrets; CREATE TABLE flag_table (flag VARCHAR(255));"
mysql -e "USE secrets; INSERT INTO flag_table VALUES ('OmahTIAcademy{weak_mysql_password_pwned}');"
mysql -e "CREATE USER 'student'@'%' IDENTIFIED BY 'password123';"
mysql -e "GRANT ALL PRIVILEGES ON secrets.* TO 'student'@'%';"
mysql -e "FLUSH PRIVILEGES;"
sed -i 's/127.0.0.1/0.0.0.0/g' /etc/mysql/mariadb.conf.d/50-server.cnf
systemctl restart mariadb

# --- Configure Tomcat ---
echo "Configuring vulnerable Tomcat Manager from config file..."
# Copy the config file from the repository
cp ./config/tomcat-users.xml /etc/tomcat9/tomcat-users.xml
echo "OmahTIAcademy{tomcat_manager_pwned}" > /var/lib/tomcat9/webapps/manager/flag.txt
systemctl restart tomcat9

# --- Configure distcc ---
echo "Configuring vulnerable distcc service..."
distccd --allow 0.0.0.0/0 --no-detach --daemon

# --- Configure Privilege Escalation Vectors ---
echo "Configuring privilege escalation vectors..."
# SUID Vector
chmod u+s /usr/bin/find
echo "OmahTIAcademy{suid_root_pwned}" > /root/suid_flag.txt
# Cron Job Vector
echo '#!/bin/bash' > /usr/local/bin/backup.sh
chmod +x /usr/local/bin/backup.sh && chmod 777 /usr/local/bin/backup.sh
echo '* * * * * root /usr/local/bin/backup.sh' > /etc/cron.d/backup
echo "OmahTIAcademy{writable_cronjob_pwned}" > /opt/cron_flag.txt

echo "Configuration settings done"
