# Easy Vulnerable Lab

## Overview

Welcome to the Easy Lab. This challenge is designed to test your understanding of fundamental enumeration, exploitation, and privilege escalation techniques. It follows a clear, linear path from initial footprinting to root access.

This lab was developed by **mshazaw** and has been used in workshops at the **OmahTI Academy**.

## Learning Objectives

* Perform network enumeration with Nmap.
* Identify and exploit a misconfigured FTP server.
* Conduct a password brute-force attack against SSH.
* Find and exploit a SUID misconfiguration to escalate privileges to root.

## Repository Structure

This lab directory contains the following components:

* **`setup.sh`**: The main script to build the vulnerable machine.
* **`/wordlists`**: Contains password lists relevant to the challenges on this machine.
* **`/solutions`**: Contains a detailed walkthrough for the intended solution path.
* **`/cve-rating`**: Contains a CVSS-based risk analysis of the vulnerabilities in this lab.

## Flags

There are three flags to capture in this challenge:

1.  **Flag 1 (Enumeration):** Found by discovering a sensitive file on the FTP server.
2.  **Flag 2 (FTP Access):** Found inside the FTP server after a successful anonymous login.
3.  **Flag 3 (Root Access):** Found in the `/root` directory after a successful privilege escalation.

## Setup Instructions

To deploy this lab, clone the entire repository to your local machine. Then, transfer the `easy-vulnerable-lab` directory to a new **Ubuntu 22.04 LTS** virtual machine or cloud Droplet. Finally, execute the setup script as the root user.

```bash
# Example of running the setup script on the target VM
chmod +x setup.sh
./setup.sh
