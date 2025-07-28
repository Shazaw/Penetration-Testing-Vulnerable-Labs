OmahTI Academy - Penetration Testing Final Project Labs

Welcome to the official repository for the OmahTI Academy Penetration Testing Final Project. This project contains three distinct, vulnerable-by-design lab environments (Easy, Medium, and Hard) created for educational purposes, as well as a legacy lab for individual demonstrations.

The labs are designed to be deployed in a cloud environment and cover the full pentesting lifecycle, from enumeration and exploitation to privilege escalation and post-exploitation.
Lab Architecture

The environment consists of a single Attacker Jump Box and separate Victim Machines, all running on a private virtual network (VPC). Students start on the Attacker Jump Box and must compromise each of the victim machines.
Labs

Each lab is contained within its own directory and includes a detailed README.md file with the challenge description, learning objectives, and a full setup script.

    Legacy Lab

        Focus: A collection of classic, individual vulnerabilities perfect for demonstrating specific tools and techniques (FTP, MySQL, distcc, Tomcat, etc.).

        Difficulty: Demonstration / Beginner
    Easy Lab

        Focus: A linear challenge covering network enumeration, SSH brute-forcing, and SUID privilege escalation.

        Difficulty: Beginner
    Medium Lab

        Focus: Web application vulnerabilities, including SQL injection and file upload bypasses, leading to a full system compromise.

        Difficulty: Intermediate
    Hard Lab

        Focus: A realistic social media application with advanced web vulnerabilities, multi-step enumeration, and privilege escalation chains.

        Difficulty: Advanced

Disclaimer

This project and all associated virtual machines are for educational and research purposes only. The vulnerabilities contained within are intentional. Do not deploy these labs in a production environment or use them for any illegal activities.

Created by OmahTI Academy
