# Legacy Vulnerable Lab

## Overview

Welcome to the Legacy Lab. This machine is not a linear, flag-based challenge like the other labs in this project. Instead, it is a playground environment designed to host a variety of classic, individual vulnerabilities. It is an ideal target for practicing specific tools and demonstrating a wide range of common misconfigurations.

This lab was developed by **mshazaw** and has been used in workshops at the **OmahTI Academy**.

## Learning Objectives

This machine is configured with multiple vulnerable services and privilege escalation paths, allowing users to practice:

* **Network Service Enumeration:** Identifying and fingerprinting services like FTP, MySQL, Tomcat, and distcc.
* **Exploiting Misconfigurations:** Gaining access through anonymous FTP login and weak database credentials.
* **Web Application Attacks:** Brute-forcing the Apache Tomcat manager and deploying a payload for remote code execution.
* **Direct RCE Exploits:** Using Metasploit to exploit a known vulnerability in `distcc`.
* **Linux Privilege Escalation:** Identifying and exploiting both SUID misconfigurations and writable cron jobs to gain root access.

## Repository Structure

This lab directory contains the following components:

* **`setup.sh`**: The main script to build the vulnerable machine.
* **`/config`**: Contains the configuration files used by the setup script to create the vulnerable services.
* **`/wordlists`**: Contains password lists relevant to the challenges on this machine.
* **`/solutions`**: Contains example walkthroughs for some of the vulnerabilities, including:
    * [Anonymous FTP](./solutions/ftp_anonymous.md)
    * [Hydra Brute-Force](./solutions/hydra_bruteforce.md)
    * [MySQL Weak Password](./solutions/mysql_weak_password.md)
    * [Distcc RCE](./solutions/distcc_rce.md)
    * [Privilege Escalation](./solutions/privilege_escalation.md)
    * [Tomcat Manager Exploit](./solutions/tomcat_exploit.md)

## Setup Instructions

To deploy this lab, clone the entire repository to your local machine. Then, transfer the `legacy-vulnerable-lab` directory to a new **Ubuntu 22.04 LTS** virtual machine or cloud Droplet. Finally, execute the setup script as the root user.

The script will automatically install and configure all the necessary services and vulnerabilities using the files provided in this repository.

```bash
# Example of running the setup script on the target VM
chmod +x setup.sh
./setup.sh
