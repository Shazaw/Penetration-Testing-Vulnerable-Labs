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

## Setup Instructions

To deploy this lab, create a new **Ubuntu 22.04 LTS** virtual machine or cloud Droplet. Then, transfer the `setup.sh` script from this directory to the machine and execute it as the root user.

The script will automatically install and configure all the necessary services and vulnerabilities.

Example of running the setup script on the target VM

chmod +x setup.sh
./setup.sh
