# Hard Vulnerable Lab

## Overview

Welcome to the Hard Lab. This is the final and most challenging lab in the series, designed to simulate a modern, multi-component web application with advanced vulnerabilities and a complex, multi-step attack path.

This lab was developed by **mshazaw** and has been used in workshops at the **OmahTI Academy**.

## Learning Objectives

* Perform multi-stage enumeration to gather credentials and clues.
* Bypass advanced file upload protections (Content-Type filtering).
* Discover and exploit a command injection vulnerability in a separate application component.
* Leverage command injection to gain a reverse shell.
* Identify and exploit a misconfigured cron job to escalate privileges to root.
* Perform post-exploitation enumeration to find hidden flags.

## Repository Structure

This lab directory contains the following components:

* **`setup.sh`**: The main script to build the vulnerable machine.
* **`/config`**: Contains the `database.sql` file used to set up the MariaDB database.
* **`/website-codebase`**: Contains the full source code for the "SocialGram" web application.
* **`/solutions`**: Contains a detailed walkthrough for the intended solution path.
* **`/cve-rating`**: Contains a CVSS-based risk analysis of the vulnerabilities in this lab.

## Flags

There are five flags to capture in this challenge:

1.  **Flag 1 (FTP Enumeration):** Found in the anonymous FTP directory.
2.  **Flag 2 (File Upload Bypass):** Found in the uploads directory after a successful Content-Type bypass.
3.  **Flag 3 (Command Injection):** Found by gaining a reverse shell from the network tool.
4.  **Flag 4 (Root Access):** Found in the `/root` directory after a successful privilege escalation.
5.  **Flag 5 (Post-Exploitation):** Found hidden deep within the `/opt` directory.

## Setup Instructions

To deploy this lab, clone the entire repository. Transfer the `hard-vulnerable-lab` directory to a new **Ubuntu 22.04 LTS** virtual machine. Finally, execute the setup script as the root user.

```bash
# Example of running the setup script on the target VM
chmod +x setup.sh
./setup.sh
