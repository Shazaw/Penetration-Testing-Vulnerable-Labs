## Hydra Brute-Force Walkthrough

1.  **Enumeration:** Through other means (e.g., the anonymous FTP server), the usernames `student` and `student2` are discovered.
2.  **Attack:** Use Hydra with the provided `legacy-passwords.txt` wordlist to brute-force the FTP login for the `student` user.
    ```bash
    hydra -l student -P ../wordlists/legacy-passwords.txt <TARGET_IP> ftp
    ```
3.  **Result:** Hydra will quickly find the valid credentials: `student:P@ssw0rd`.
4.  **Access:** These credentials can then be used to log into the FTP or SSH services.
