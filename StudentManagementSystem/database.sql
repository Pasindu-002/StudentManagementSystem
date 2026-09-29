CREATE DATABASE IF NOT EXISTS student_management
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE student_management;


-- ==========================================
-- USERS TABLE
-- ==========================================

DROP TABLE IF EXISTS students;
DROP TABLE IF EXISTS users;


CREATE TABLE users (

    id INT AUTO_INCREMENT PRIMARY KEY,

    username VARCHAR(50)
        NOT NULL UNIQUE,

    password VARCHAR(255)
        NOT NULL

);


-- ==========================================
-- STUDENTS TABLE
-- ==========================================

CREATE TABLE students (

    id INT AUTO_INCREMENT PRIMARY KEY,

    student_id VARCHAR(20)
        NOT NULL UNIQUE,

    full_name VARCHAR(100)
        NOT NULL,

    dob DATE
        NOT NULL,

    gender VARCHAR(20)
        NOT NULL,

    email VARCHAR(100)
        NOT NULL,

    phone VARCHAR(20)
        NOT NULL,

    address TEXT
        NOT NULL,

    course VARCHAR(150)
        NOT NULL,

    year INT
        NOT NULL,

    enrollment_date DATE
        NOT NULL,

    created_at TIMESTAMP
        DEFAULT CURRENT_TIMESTAMP

);


-- ==========================================
-- ADMIN USER
-- Username: admin
-- Password: admin123
-- ==========================================

INSERT INTO users
(
    username,
    password
)
VALUES
(
    'admin',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4f1hZJY9xK6r5x8xK6r5x8xK6r5x8xK6'
);


-- ==========================================
-- SAMPLE STUDENTS
-- ==========================================

INSERT INTO students
(
    student_id,
    full_name,
    dob,
    gender,
    email,
    phone,
    address,
    course,
    year,
    enrollment_date
)
VALUES

(
    'ST001',
    'John Perera',
    '2004-05-15',
    'Male',
    'john@gmail.com',
    '0771234567',
    'Colombo, Sri Lanka',
    'BSc Hons in Computer Networks',
    2,
    '2025-09-01'
),

(
    'ST002',
    'Kasun Silva',
    '2005-02-20',
    'Male',
    'kasun@gmail.com',
    '0772345678',
    'Gampaha, Sri Lanka',
    'BSc Hons in Computer Networks',
    1,
    '2026-01-10'
),

(
    'ST003',
    'Nethmi Fernando',
    '2004-08-10',
    'Female',
    'nethmi@gmail.com',
    '0773456789',
    'Negombo, Sri Lanka',
    'BSc Hons in Computer Networks',
    3,
    '2024-09-01'
);