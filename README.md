# 🏛️ Majaaz Architectural Competition Portal

A full-stack web platform for managing national architectural competitions across Iraq.
Built with PHP, MySQL, HTML, CSS, and JavaScript.

---

## 📌 About the Project

Majaaz is a web-based information management system designed to organize and manage
architectural competition workflows — from project submissions to jury evaluations —
across multiple cities in Iraq.

The system supports three user roles with dedicated dashboards and workflows.

---

## 👥 User Roles

| Role | Capabilities |
|------|-------------|
| **Admin** | Manage projects, assign jury members, oversee evaluations |
| **Jury** | Review submitted projects, submit scores and evaluations |
| **Participant** | Submit architectural projects and upload images |

---

## ✨ Features

- 🔐 Secure authentication system with role-based access control
- 📁 Project submission and image upload management
- ⚖️ Jury evaluation and scoring workflows
- 📊 Admin dashboard for competition oversight
- 🗄️ Relational database with structured schema (MySQL)
- 🔒 Security measures including session management and input validation
- 📱 Responsive web interface (HTML, CSS, JavaScript)

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | PHP 8+ (PDO, REST API) |
| Frontend | HTML5, CSS3, JavaScript |
| Database | MySQL |
| Server | Apache (XAMPP) |
| Version Control | Git / GitHub |

---

## 📁 Project Structure
```
majaaz_portal/
├── api/                  # REST API endpoints
│   ├── login.php
│   ├── logout.php
│   ├── admin_create_jury.php
│   ├── admin_create_project.php
│   ├── jury_save_evaluation.php
│   └── bootstrap.php
├── v1/                   # Version 1 - server-rendered UI
│   ├── admin/            # Admin panel pages
│   ├── jury/             # Jury evaluation pages
│   ├── auth/             # Login / logout
│   └── includes/         # Header, footer components
├── v2/                   # Version 2 - API-driven architecture
├── sql/                  # Database schema
│   └── schema.sql
├── uploads/              # Project image uploads
├── config.php            # DB configuration (not tracked)
└── index.php             # Entry point
```

---

## ⚙️ Installation

1. **Clone the repository**
```bash
   git clone https://github.com/mhmadip/majaaz_portal.git
```

2. **Move to your web server directory**
```bash
   # For XAMPP on Mac
   cp -r majaaz_portal /Applications/XAMPP/xamppfiles/htdocs/
```

3. **Create the database**
   - Open phpMyAdmin
   - Create a database named `majaaz_portal`
   - Import `sql/schema.sql`

4. **Configure the database**
```php
   // Create config.php in the root folder
   $dbHost = "127.0.0.1";
   $dbName = "majaaz_portal";
   $dbUser = "root";
   $dbPass = "your_password";
```

5. **Run the project**
   - Start Apache and MySQL in XAMPP
   - Visit `http://localhost/majaaz_portal`

---

## 🔒 Security Notes

- `config.php` is excluded from version control via `.gitignore`
- Passwords are hashed before storage
- All database queries use PDO prepared statements
- Role-based access control on all API endpoints
- File upload validation restricted to image types only

---

## 👨‍💻 Developer

**Mohammad Salim Abdulrahman**
PhD Candidate in Cybersecurity — Universiti Kebangsaan Malaysia (UKM)
Lecturer & IT Specialist — Erbil, Kurdistan Region, Iraq

📧 mhmadip@gmail.com
🐙 github.com/mhmadip

---

## 📄 License

This project is private and developed for the Majaaz Architectural Competition — Iraq.

