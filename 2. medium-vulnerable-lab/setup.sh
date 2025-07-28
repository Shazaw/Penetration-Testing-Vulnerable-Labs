#!/bin/bash

echo "[*] Starting Medium Lab setup..."
echo "[*] This will install a full LAMP stack and may take several minutes."

# --- Wait for background updates to finish ---
while fuser /var/lib/dpkg/lock-frontend >/dev/null 2>&1; do
   echo "[!] Waiting for other package manager process to finish..."
   sleep 10
done

# --- Install LAMP Stack and SSH ---
echo "Installing required packages..."
apt-get update > /dev/null 2>&1
apt-get install -y apache2 php libapache2-mod-php mariadb-server php-mysql openssh-server > /dev/null 2>&1

# --- Configure SSH to allow password login ---
echo "Configuring SSH for password authentication..."
sed -i 's/PasswordAuthentication no/PasswordAuthentication yes/g' /etc/ssh/sshd_config
systemctl restart sshd

# --- Create User ---
echo "Creating user 'admin426'..."
useradd -m -s /bin/bash admin426

# --- Configure Database from SQL file ---
echo "Configuring MariaDB database from config file..."
systemctl start mariadb
mysql < ./config/database.sql

# --- Create Web Application from Codebase ---
echo "Setting up the web application..."
cp -r ./website-codebase/* /var/www/html/
rm -f /var/www/html/index.html
mkdir -p /var/www/html/uploads
echo "The SSH password for admin426 is: SuperHardPassword123!" > /var/www/html/uploads/admin_password.txt
echo "OmahTIAcademy{F1l3_Uplo@d_@ttacks}" > /var/www/html/uploads/flag3.txt
chown -R www-data:www-data /var/www/html/uploads

# --- Configure Privilege Escalation (Cron Job) ---
echo "Configuring cron job privilege escalation vector..."
echo "admin426:SuperHardPassword123!" | chpasswd
echo '#!/bin/bash' > /usr/local/bin/backup.sh
chmod +x /usr/local/bin/backup.sh && chmod 777 /usr/local/bin/backup.sh
echo '* * * * * root /usr/local/bin/backup.sh' > /etc/cron.d/backup

# --- Place Final Root Flag ---
echo "Placing final root flag..."
echo "OmahTIAcademy{M3d1um_R00t_Acc35s}" > /root/flag4.txt

echo "Medium Lab Setup Complete!"
