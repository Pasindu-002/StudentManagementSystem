<?php

session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");

    exit();
}

require_once "config/database.php";


/*
|--------------------------------------------------------------------------
| Dashboard Statistics
|--------------------------------------------------------------------------
*/

$totalStudents = $conn
    ->query(
        "SELECT COUNT(*) AS total
         FROM students"
    )
    ->fetch_assoc()["total"];


$maleStudents = $conn
    ->query(
        "SELECT COUNT(*) AS total
         FROM students
         WHERE gender = 'Male'"
    )
    ->fetch_assoc()["total"];


$femaleStudents = $conn
    ->query(
        "SELECT COUNT(*) AS total
         FROM students
         WHERE gender = 'Female'"
    )
    ->fetch_assoc()["total"];


$yearFourStudents = $conn
    ->query(
        "SELECT COUNT(*) AS total
         FROM students
         WHERE year = 4"
    )
    ->fetch_assoc()["total"];


/*
|--------------------------------------------------------------------------
| Recent Students
|--------------------------------------------------------------------------
*/

$recentStudents = $conn->query(
    "SELECT *
     FROM students
     ORDER BY id DESC
     LIMIT 5"
);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
Dashboard | Student Management System
</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="assets/css/style.css">

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar navbar-dark bg-primary shadow-sm">

<div class="container">

<a
href="dashboard.php"
class="navbar-brand fw-bold">

🎓 Student Management System

</a>

<div>

<span class="text-white me-3">

Welcome,
<?php

echo htmlspecialchars(
    $_SESSION["username"]
);

?>

</span>

<a
href="logout.php"
class="btn btn-danger btn-sm">

Logout

</a>

</div>

</div>

</nav>


<!-- MAIN -->

<div class="container py-5">

<div
class="d-flex justify-content-between align-items-center mb-5">

<div>

<h2 class="fw-bold">
Dashboard
</h2>

<p class="text-muted">
Student Management System Overview
</p>

</div>

<a
href="students/add.php"
class="btn btn-success">

+ Add Student

</a>

</div>


<!-- STATISTICS -->

<div class="row g-4 mb-5">


<div class="col-md-3">

<div class="stat-card">

<span>
Total Students
</span>

<strong>
<?php echo $totalStudents; ?>
</strong>

</div>

</div>


<div class="col-md-3">

<div class="stat-card">

<span>
Male Students
</span>

<strong>
<?php echo $maleStudents; ?>
</strong>

</div>

</div>


<div class="col-md-3">

<div class="stat-card">

<span>
Female Students
</span>

<strong>
<?php echo $femaleStudents; ?>
</strong>

</div>

</div>


<div class="col-md-3">

<div class="stat-card">

<span>
Year 4 Students
</span>

<strong>
<?php echo $yearFourStudents; ?>
</strong>

</div>

</div>


</div>


<!-- RECENT STUDENTS -->

<div class="card shadow-sm">

<div
class="card-header bg-white d-flex justify-content-between align-items-center">

<h5 class="mb-0">

Recently Added Students

</h5>

<a
href="students/view.php"
class="btn btn-primary btn-sm">

View All

</a>

</div>


<div class="card-body">

<div class="table-responsive">

<table
class="table table-hover align-middle">

<thead class="table-primary">

<tr>

<th>
Student ID
</th>

<th>
Name
</th>

<th>
Email
</th>

<th>
Course
</th>

<th>
Year
</th>

</tr>

</thead>


<tbody>

<?php

if ($recentStudents->num_rows > 0):

while (
    $student =
    $recentStudents->fetch_assoc()
):

?>

<tr>

<td>

<?php

echo htmlspecialchars(
    $student["student_id"]
);

?>

</td>


<td>

<?php

echo htmlspecialchars(
    $student["full_name"]
);

?>

</td>


<td>

<?php

echo htmlspecialchars(
    $student["email"]
);

?>

</td>


<td>

<?php

echo htmlspecialchars(
    $student["course"]
);

?>

</td>


<td>

<span class="badge bg-info text-dark">

Year
<?php echo $student["year"]; ?>

</span>

</td>

</tr>

<?php

endwhile;

else:

?>

<tr>

<td
colspan="5"
class="text-center text-muted py-4">

No students found.

</td>

</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</body>

</html>