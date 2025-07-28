#!/bin/bash

echo "[*] Starting Easy Lab setup..."

# --- Wait for background updates to finish ---
while fuser /var/lib/dpkg/lock-frontend >/dev/null 2>&1; do
   echo "[!] Waiting for other package manager process to finish..."
   sleep 10
done

# --- Install Services ---
echo "Installing required services (vsftpd, openssh-server)..."
apt-get update > /dev/null 2>&1
apt-get install -y vsftpd openssh-server > /dev/null 2>&1

# --- Configure SSH to allow password login ---
echo "Configuring SSH for password authentication..."
sed -i 's/PasswordAuthentication no/PasswordAuthentication yes/g' /etc/ssh/sshd_config
systemctl restart sshd

# --- Create User and Set Password ---
echo "Creating user 'easyuser' with password 'R3sistance'..."
useradd -m -s /bin/bash easyuser
echo "easyuser:R3sistance" | chpasswd

# --- Configure FTP ---
echo "Configuring anonymous FTP from config file..."
# Copy the config file from the repository
cp ./config/vsftpd.conf /etc/vsftpd.conf

mkdir -p /var/ftp
# Flag 1: Found after login
echo "OmahTIAcademy{anon_ftp_access}" > /var/ftp/flag1.txt
# Clues for the next step
echo "The user account on this machine is 'easyuser'." > /var/ftp/note.txt
cp ./wordlists/easy-passwords.txt /var/ftp/wordlist.txt
# Flag 2: Found via ssh into easyuser
echo "OmahTIAcademy{Easy_ssh_flag}" > /home/easyuser/flag2.txt
# Set correct permissions
chown ftp:nogroup /var/ftp/*
chmod 644 /var/ftp/*
systemctl restart vsftpd

# --- Configure Privilege Escalation (SUID on 'find') ---
echo "Configuring SUID privilege escalation vector..."
chmod u+s /usr/bin/find

# --- Place Final Root Flag ---
echo "Placing final root flag..."
echo "OmahTIAcademy{easy_root_pwned}" > /root/flag3.txt

echo "Easy Lab Setup Complete!"
