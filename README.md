# PHP Login & Registration System (XAMPP Localhost)

This is a **local login and registration system** built with PHP, MySQL, and Bootstrap.  
It is designed to be run on a **local XAMPP server** and accessed via the browser at:

[localhost](http://localhost/login_formular/registration.php)

> 💡 **Note:** You can use any browser of your choice. This is a localhost-only setup for development and learning.

## 🧰 Recommended Setup

### 🖥️ Requirements
- [XAMPP](https://www.apachefriends.org/) (Apache + MySQL Server),
- [Visual Studio Code (VS Code)](https://code.visualstudio.com/),
- PHP Extension for VS Code: _"PHP Extension Pack"_ or at least _"PHP Intelephense"_

## 🚀 Getting Started

### 🔽 1. Download & Install XAMPP

- Go to: [https://www.apachefriends.org/](https://www.apachefriends.org/),
- Download and install XAMPP (during the installation process: only APACHE and MYSQL is necessary),
- Open the XAMPP Control Panel,
  - Start **Apache**,
  - Start **MySQL**

### 📦 2. Clone or Download the Project

Open your terminal (PowerShell or VS Code terminal) or use Git Bash, then run:

```bash
cd C:\xampp\htdocs
git clone https://github.com/yourusername/login_formular.git
```    
---

## 🔐 Features

* Secure registration with form validation,

* Passwords hashed using password_hash(),

* Login with secure password_verify(),

* Sessions to manage login state,

* SQL Injection protection via prepared statements

## 🧩 Technologies Used

* PHP,

* MySQL (via phpMyAdmin),

* Bootstrap 5,

* HTML/CSS,

* VS Code + PHP Extension,

## 📁 Folder Structure

```plaintext
/ (Project Root)
│
├── index.php           # User dashboard (visible after login)
├── login.php           # Login page for existing users
├── registration.php    # Form for new user registration
├── database.php        # Handles MySQL database connection
├── style.css           # Custom styling (Bootstrap + personal styles)
├── LICENCE.txt         # APACHE LICENSE 2.0
└── README.md           # This documentation file
