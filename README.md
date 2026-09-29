# Student Management System

A web-based application built with PHP and MySQL designed to streamline student data management. This project provides an interface to view, add, edit, and delete student records, manage user authentication, and control system navigation.

---

## Features

- **User Authentication**: Secure login and logout functionality for system access.
- **Dashboard**: Centralized hub displaying system overviews and key navigation links.
- **Student CRUD Operations**:
  - **Create**: Add new student profiles with required details.
  - **Read**: View list of all registered students and detailed profiles.
  - **Update**: Edit existing student records.
  - **Delete**: Remove student entries from the system.
- **Password Utility**: Includes a utility script (`make_password.php`) for generating hashed passwords.

---

## Tech Stack

- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP
- **Database**: MySQL

---

## Directory Structure

```text
StudentManagementSystem/
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── script.js
├── config/
│   └── database.php
├── students/
│   ├── add.php
│   ├── delete.php
│   ├── edit.php
│   └── view.php
├── dashboard.php
├── database.sql
├── index.php
├── login.php
├── logout.php
├── make_password.php
└── README.md
