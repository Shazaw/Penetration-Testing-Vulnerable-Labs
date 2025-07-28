## Anonymous FTP Walkthrough

1.  **Enumeration:** A port scan (`nmap <TARGET_IP>`) reveals that port 21 (FTP) is open. An Nmap script scan (`nmap -p 21 --script ftp-anon <TARGET_IP>`) confirms that anonymous login is allowed.
2.  **Connection:** Connect to the server using any FTP client.
    ```bash
    ftp <TARGET_IP>
    ```
3.  **Authentication:** When prompted, use the username `anonymous` and a blank password.
4.  **Looting:** Once logged in, use the `ls` command to list files and `get <filename>` to download them. The flag is located in the `FLAG_ENUM.txt` file.
