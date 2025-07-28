# Medium Vulnerable Lab

## Overview

Welcome to the Medium Lab. This challenge introduces web application security concepts and requires a multi-step exploitation path to achieve full system compromise.

This lab was developed by **mshazaw** and has been used in workshops at the **OmahTI Academy**.

## Learning Objectives

* Perform web enumeration to discover hidden files (`robots.txt`).
* Exploit a classic SQL injection vulnerability to bypass authentication.
* Exploit an unrestricted file upload vulnerability to gain a web shell.
* Pivot from a web shell to a system shell by finding credentials.
* Identify and exploit a misconfigured cron job to escalate privileges to root.

## Repository Structure

This lab directory contains the following components:

* **`setup.sh`**: The main script to build the vulnerable machine.
* **`/config`**: Contains the `database.sql` file used to set up the MariaDB database.
* **`/website-codebase`**: Contains the source code for the vulnerable web application.
* **`/solutions`**: Contains a detailed walkthrough for the intended solution path.
* **`/cve-rating`**: Contains a CVSS-based risk analysis of the vulnerabilities in this lab.

## Flags

There are four flags to capture in this challenge:

1.  **Flag 1 (Web Enumeration):** Found in the webroot after analyzing `robots.txt`.
2.  **Flag 2 (SQL Injection):** Found on the profile page after a successful login bypass.
3.  **Flag 3 (File Upload):** Found in the uploads directory after gaining a web shell.
4.  **Flag 4 (Root Access):** Found in the `/root` directory after a successful privilege escalation.

## Setup Instructions

To deploy this lab, clone the entire repository to your local machine. Then, transfer the `medium-vulnerable-lab` directory to a new **Ubuntu 22.04 LTS** virtual machine or cloud Droplet. Finally, execute the setup script as the root user.

```bash
# Example of running the setup script on the target VM
chmod +x setup.sh
./setup.sh
