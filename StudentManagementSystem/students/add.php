<?php

session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: ../login.php");

    exit();
}

require_once "../config/database.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $student_id =
        trim($_POST["student_id"]);

    $full_name =
        trim($_POST["full_name"]);

    $dob =
        $_POST["dob"];

    $gender =
        $_POST["gender"];

    $email =
        trim($_POST["email"]);

    $phone =
        trim($_POST["phone"]);

    $address =
        trim($_POST["address"]);

    $course =
        trim($_POST["course"]);

    $year =
        (int) $_POST["year"];

    $enrollment_date =
        $_POST["enrollment_date"];


    $stmt = $conn->prepare(

        "INSERT INTO students
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
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"

    );


    $stmt->bind_param(

        "ssssssssss",

        $student_id,
        $full_name,
        $dob,
        $gender,
        $email,
        $phone,
        $address,
        $course,
        $year,
        $enrollment_date

    );


    if ($stmt->execute()) {

        header(
            "Location: view.php?success=added"
        );

        exit();

    } else {

        $error =
            "Unable to add student. Student ID may already exist.";

    }

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
Add Student
</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="../assets/css/style.css">

</head>

<body>

<nav class="navbar navbar-dark bg-primary">

<div class="container">

<a
href="../dashboard.php"
class="navbar-brand fw-bold">

🎓 Student Management System

</a>

<a
href="../logout.php"
class="btn btn-danger btn-sm">

Logout

</a>

</div>

</nav>


<div class="container py-5">

<div class="card shadow-sm">

<div class="card-header bg-primary text-white">

<h4 class="mb-0">
Add New Student
</h4>

</div>


<div class="card-body p-4">

<?php if ($error): ?>

<div class="alert alert-danger">

<?php

echo htmlspecialchars($error);

?>

</div>

<?php endif; ?>


<form method="POST">

<div class="row g-3">


<div class="col-md-6">

<label class="form-label">
Student ID
</label>

<input
type="text"
name="student_id"
class="form-control"
placeholder="ST001"
required>

</div>


<div class="col-md-6">

<label class="form-label">
Full Name
</label>

<input
type="text"
name="full_name"
class="form-control"
required>

</div>


<div class="col-md-6">

<label class="form-label">
Date of Birth
</label>

<input
type="date"
name="dob"
class="form-control"
required>

</div>


<div class="col-md-6">

<label class="form-label">
Gender
</label>

<select
name="gender"
class="form-select"
required>

<option value="">
Select Gender
</option>

<option value="Male">
Male
</option>

<option value="Female">
Female
</option>

<option value="Other">
Other
</option>

</select>

</div>


<div class="col-md-6">

<label class="form-label">
Email
</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>


<div class="col-md-6">

<label class="form-label">
Phone
</label>

<input
type="text"
name="phone"
class="form-control"
required>

</div>


<div class="col-12">

<label class="form-label">
Address
</label>

<textarea
name="address"
class="form-control"
rows="3"
required></textarea>

</div>


<div class="col-md-6">

<label class="form-label">
Course
</label>

<input
type="text"
name="course"
class="form-control"
value="BSc Hons in Computer Networks"
required>

</div>


<div class="col-md-3">

<label class="form-label">
Year
</label>

<select
name="year"
class="form-select"
required>

<option value="">
Select
</option>

<option value="1">
Year 1
</option>

<option value="2">
Year 2
</option>

<option value="3">
Year 3
</option>

<option value="4">
Year 4
</option>

</select>

</div>


<div class="col-md-3">

<label class="form-label">
Enrollment Date
</label>

<input
type="date"
name="enrollment_date"
class="form-control"
required>

</div>


</div>


<div class="mt-4">

<button
type="submit"
class="btn btn-success">

Add Student

</button>

<a
href="view.php"
class="btn btn-secondary">

Cancel

</a>

</div>

</form>

</div>

</div>

</div>

</body>

</html>