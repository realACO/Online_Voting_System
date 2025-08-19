# Online Voting System

An **Online Voting System** built using **PHP**, **MySQL**, and **XAMPP**.  
It provides a simple and secure way to manage elections, register voters, and allow users to cast their votes online.

---

## 🚀 Features and screenshots

- Admin and Voter login system  
- Admin can create and manage elections  
- Admin can add/manage candidates  
- Voters can register and cast one vote per election  
- Results page to display election outcomes  

<img width="1352" height="639" alt="OVS" src="https://github.com/user-attachments/assets/8d19bfda-49f3-4555-a622-527f3f8653f6" />
<img width="1366" height="637" alt="Capture" src="https://github.com/user-attachments/assets/1fda4963-0ae1-4b50-80aa-eecbcac8fb6b" />


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

# 🗳️ Online Voting System

## 🔧 Setup Instructions (XAMPP)

### 1. Download or Clone the Repository
```bash
git clone https://github.com/realACO/Online_Voting_System.git
```

Place the folder inside the `htdocs` directory of your XAMPP installation. Example:

```
C:\xampp\htdocs\Online_Voting_System
```

---

### 2. Open the XAMPP Control Panel
- Start **Apache** and **MySQL** modules

---

### 3. Create the Database
1. Open **phpMyAdmin**  
2. Create a new database, e.g. `online_voting`  
3. Import the provided SQL file or manually create tables based on the `api` scripts  

---

### 4. Configure Database Connection
Edit `api/config.php` (or equivalent) and update with your local DB credentials:

```php
<?php
$host = "localhost";
$user = "root"; // default XAMPP user
$pass = "";     // default is empty
$db   = "online_voting";
?>
```

---

### 5. Run the Project
Open your browser and go to:

```
http://localhost/Online_Voting_System
```

---

## 👩‍💼 User Roles

### Admin
- Create/manage elections  
- Add/manage candidates  
- Register voters  
- View results  

### Voter
- Register and log in  
- Cast one vote per election  

---

## 🔒 Notes
- Works with XAMPP default settings (`root` user, no password`)  
- Always import the database before running the app  
- Enable sessions in PHP if disabled  
- For production, set a MySQL password and configure `config.php` accordingly  

---

## 📄 License
This project is open-source and free to use for learning or real-world applications.


