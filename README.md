
# Penetration Testing Vulnerable Labs

Welcome to **Penetration Testing Vulnerable Labs**, a comprehensive collection of vulnerable lab environments designed for security professionals, students, and enthusiasts to practice their skills in a legal and controlled environment. This is a personal project by **mshazaw**, featuring a series of labs that were developed for and used in workshops at the **OmahTI Academy**.

## Project Overview

This repository contains a set of fictional, vulnerable-by-design applications and servers. The goal is to provide a hands-on learning experience for identifying and exploiting common vulnerabilities across different technology stacks and difficulty levels.

Inspired by classic training environments like DVWA, this project provides a structured and realistic set of challenges for learning and practice.

## The Labs

This repository is organized into four distinct labs, each with its own unique set of challenges and learning objectives. Please see the `README.md` file inside each lab's directory for detailed setup instructions and challenge information.

* ### [Legacy Lab](./legacy-vulnerable-lab/README.md)
    An older, unsupported application representing the risks of outdated software and classic network service misconfigurations.

* ### [Easy Lab](./easy-vulnerable-lab/README.md)
    A straightforward challenge path with common vulnerabilities, perfect for beginners learning the fundamentals.

* ### [Medium Lab](./medium-vulnerable-lab/README.md)
    A more challenging scenario involving a multi-step exploitation path through a web application.

* ### [Hard Lab](./hard-vulnerable-lab/README.md)
    The most difficult lab, requiring advanced techniques to compromise a modern, multi-component web application.

## 🛠️ General Setup and Installation

Each lab is self-contained within its own directory. Generally, you will need a standard web server environment (like LAMP/LEMP/XAMPP) with:

* Apache/Nginx
* PHP
* MySQL/MariaDB

Please refer to the `README.md` file inside each lab's directory for specific setup scripts and configuration details.

## ⚠Disclaimer

**This project is for educational and research purposes only.** The vulnerabilities included are intentional. Please do not deploy these labs on a live, production server or any public-facing network. The project author, mshazaw, is not responsible for any misuse or damage caused by this software.
