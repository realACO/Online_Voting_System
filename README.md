# Online Voting System

An **Online Voting System** built using **PHP**, **MySQL**, and **XAMPP**.  
It provides a simple and secure way to manage elections, register voters, and allow users to cast their votes online.

---

## 🚀 Features

- Admin and Voter login system  
- Admin can create and manage elections  
- Admin can add/manage candidates  
- Voters can register and cast one vote per election  
- Results page to display election outcomes  

---

## 🗂️ Project Structure

Online_Voting_System/
├── api/ # Backend PHP scripts and database queries
├── routes/ # Route/page controllers
├── css/ # Stylesheets for frontend
├── images/ # Static images and assets
├── index.php # Main entry point
└── README.md # Documentation

yaml
Copy
Edit

---

## ⚙️ Requirements

- [XAMPP](https://www.apachefriends.org/) (with **Apache** and **MySQL**)  
- PHP 7.4+  
- MySQL / MariaDB  

---

# 🔧 Setup Instructions (XAMPP)

### Download or Clone the Repository
```bash
git clone https://github.com/realACO/Online_Voting_System.git
Place the folder inside the htdocs directory of your XAMPP installation. Example:

makefile
Copy
Edit
C:\xampp\htdocs\Online_Voting_System
Open the XAMPP Control Panel
Start Apache and MySQL modules

Create the Database
Open phpMyAdmin

Create a new database, e.g. online_voting

Import the provided SQL file or manually create tables based on the api scripts

Configure Database Connection
Edit api/config.php (or equivalent) and update with your local DB credentials:

php
Copy
Edit
<?php
$host = "localhost";
$user = "root"; // default XAMPP user
$pass = "";     // default is empty
$db   = "online_voting";
?>
Run the Project
Open your browser and go to:

arduino
Copy
Edit
http://localhost/Online_Voting_System
👩‍💼 User Roles
Admin
Create/manage elections

Add/manage candidates

Register voters

View results

Voter
Register and log in

Cast one vote per election

🔒 Notes
Works with XAMPP default settings (root user, no password)

Always import the database before running the app

Enable sessions in PHP if disabled

For production, set a MySQL password and configure config.php accordingly

📄 License
This project is open-source and free to use for learning or real-world applications.

