# Student Management System

A web-based student management system developed using **PHP, MySQL, HTML, CSS, JavaScript, and Bootstrap**.

The application provides an administrator interface for managing student records through a database-driven web application.

---

## 🚀 Tech Stack

* **PHP**
* **MySQL**
* **HTML5**
* **CSS3**
* **JavaScript**
* **Bootstrap**

---

## 📌 Project Features

### 🔐 Administrator Authentication

* Administrator login and logout
* PHP session-based authentication
* Protected application pages
* Password hashing and verification

### 👨‍🎓 Student Management

The system supports:

* Add student records
* View student records
* Edit student records
* Delete student records
* Search students

### 🔎 Student Search

Students can be searched using information such as:

* Student ID
* Name
* Email
* Course

### 🗄️ Database Integration

The application uses **MySQL** for persistent storage of student information.

Prepared SQL statements are used for database operations.

---

## 🏗️ Application Structure

```text id="q3u0k8"
StudentManagementSystem
│
├── login.php
├── logout.php
├── dashboard.php
│
├── students
│   ├── add.php
│   ├── edit.php
│   ├── delete.php
│   └── view.php
│
├── config
│
├── assets
│   ├── css
│   └── js
│
└── database.sql
```

---

## 🔑 Authentication

The application implements administrator authentication using PHP sessions.

Password hashing and verification are used for handling administrator credentials.

Authenticated sessions are required to access protected management functionality.

---

## 🧩 CRUD Operations

The application implements the four fundamental database operations:

| Operation | Functionality                   |
| --------- | ------------------------------- |
| Create    | Add new student records         |
| Read      | View and search student records |
| Update    | Edit existing student records   |
| Delete    | Remove student records          |

---

## 🗄️ Database

The project includes a SQL database script
