#!/bin/bash

echo "[*] Starting Hard Lab setup..."
echo "[*] This will install a full LAMP stack and may take several minutes."

# --- Wait for background updates to finish ---
while fuser /var/lib/dpkg/lock-frontend >/dev/null 2>&1; do
   echo "[!] Waiting for other package manager process to finish..."
   sleep 10
done

# --- Install All Services ---
echo "Installing required packages..."
apt-get update > /dev/null 2>&1
apt-get install -y apache2 php libapache2-mod-php mariadb-server php-mysql openssh-server vsftpd > /dev/null 2>&1

# --- Configure System Services ---
echo "Configuring SSH and FTP..."
sed -i 's/PasswordAuthentication no/PasswordAuthentication yes/g' /etc/ssh/sshd_config
systemctl restart sshd

echo "Configuring anonymous FTP from config file..."
# Copy the config file from the repository
cp ./config/vsftpd.conf /etc/vsftpd.conf
mkdir -p /var/ftp

echo "OmahTIAcademy{hard_ftp_enum_start}" > /var/ftp/flag1.txt
echo -e 'Found a credential!\nUsername: webdeveloper\nPassword: ComplexPass2025!' > /var/ftp/creds.txt
chown ftp:nogroup /var/ftp/*
chmod 644 /var/ftp/*
systemctl restart vsftpd

# --- Create System User ---
echo "Creating user 'webdeveloper'..."
useradd -m -s /bin/bash webdeveloper
echo "webdeveloper:ComplexPass2025!" | chpasswd

# --- Configure Database from SQL file ---
echo "Configuring MariaDB database from config file..."
systemctl start mariadb
mysql < ./config/database.sql

# --- Create Web Application from Codebase ---
echo "Setting up the web application..."
cp -r ./website-codebase/* /var/www/html/
rm -f /var/www/html/index.html

# --- Create Segregated Network Tool ---
echo "Creating segregated network tool in /opt/tools..."
mkdir -p /opt/tools
cp ./website-codebase/network_tool.php /opt/tools/index.php
# Create Apache config to serve this from /tools
cat <<'EOF' > /etc/apache2/conf-available/tools.conf
Alias /tools /opt/tools
<Directory /opt/tools>
    Options Indexes FollowSymLinks
    AllowOverride None
    Require all granted
</Directory>
EOF
a2enconf tools > /dev/null 2>&1

# --- Place Flags and Clues ---
echo "Placing flags and clues..."
echo "OmahTIAcademy{content_type_bypass}" > /var/www/html/uploads/avatars/flag2.txt
echo "Clue: Our developers left a network testing tool online. Find it at /tools/" > /var/www/html/uploads/avatars/clue.txt
echo "OmahTIAcademy{command_injection_rce}" > /var/www/flag3.txt

# --- Configure Privilege Escalation ---
echo "Configuring privilege escalation vectors..."
# Cron Job
echo '#!/bin/bash' > /usr/local/bin/backup.sh
chmod +x /usr/local/bin/backup.sh && chmod 777 /usr/local/bin/backup.sh
echo '* * * * * root /usr/local/bin/backup.sh' > /etc/cron.d/backup
# Final Flags
echo "OmahTIAcademy{hard_root_pwned}" > /root/flag4.txt
mkdir -p /opt/deep/secret/folder
echo "OmahTIAcademy{hidden_opt_flag}" > /opt/deep/secret/folder/flag5.txt

# --- Final Permissions and Restart ---
echo "Setting final permissions and restarting services..."
chown -R www-data:www-data /var/www/html
chown -R www-data:www-data /var/www/flag3.txt
systemctl restart apache2

echo "Hard Lab Setup Complete!"
