<?php

session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: ../login.php");

    exit();
}

require_once "../config/database.php";

$search =
    trim($_GET["search"] ?? "");


if ($search !== "") {

    $stmt = $conn->prepare(

        "SELECT *
         FROM students

         WHERE student_id LIKE ?
         OR full_name LIKE ?
         OR email LIKE ?
         OR course LIKE ?

         ORDER BY id DESC"

    );

    $searchValue =
        "%" . $search . "%";

    $stmt->bind_param(

        "ssss",

        $searchValue,
        $searchValue,
        $searchValue,
        $searchValue

    );

    $stmt->execute();

    $students =
        $stmt->get_result();

} else {

    $students =
        $conn->query(

            "SELECT *
             FROM students
             ORDER BY id DESC"

        );

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
Student Records
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
href="../logout.php"
class="btn btn-danger btn-sm">

Logout

</a>

</div>

</div>

</nav>


<div class="container py-5">


<div
class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2 class="fw-bold">
Student Records
</h2>

<p class="text-muted">
Manage student information
</p>

</div>


<div>

<a
href="../dashboard.php"
class="btn btn-secondary">

Dashboard

</a>

<a
href="add.php"
class="btn btn-success">

+ Add Student

</a>

</div>

</div>


<?php if (isset($_GET["success"])): ?>

<div class="alert alert-success alert-dismissible fade show">

<?php

if ($_GET["success"] === "added") {

    echo "Student added successfully.";

}

elseif ($_GET["success"] === "updated") {

    echo "Student updated successfully.";

}

elseif ($_GET["success"] === "deleted") {

    echo "Student deleted successfully.";

}

?>

<button
type="button"
class="btn-close"
data-bs-dismiss="alert">
</button>

</div>

<?php endif; ?>


<!-- SEARCH -->

<div class="card shadow-sm mb-4">

<div class="card-body">

<form method="GET">

<div class="input-group">

<input
type="text"
name="search"
class="form-control"
placeholder="Search by ID, name, email or course..."
value="<?php

echo htmlspecialchars($search);

?>">

<button
type="submit"
class="btn btn-primary">

Search

</button>

<a
href="view.php"
class="btn btn-secondary">

Reset

</a>

</div>

</form>

</div>

</div>


<!-- TABLE -->

<div class="card shadow-sm">

<div class="card-body">

<div class="table-responsive">

<table
class="table table-bordered table-hover align-middle">

<thead class="table-primary">

<tr>

<th>
#
</th>

<th>
Student ID
</th>

<th>
Name
</th>

<th>
Gender
</th>

<th>
Email
</th>

<th>
Phone
</th>

<th>
Course
</th>

<th>
Year
</th>

<th>
Actions
</th>

</tr>

</thead>


<tbody>

<?php

if ($students->num_rows > 0):

$count = 1;

while (
    $student =
    $students->fetch_assoc()
):

?>

<tr>

<td>
<?php echo $count++; ?>
</td>

<td>

<strong>

<?php

echo htmlspecialchars(
    $student["student_id"]
);

?>

</strong>

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
    $student["gender"]
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
    $student["phone"]
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

<span
class="badge bg-info text-dark">

Year
<?php echo $student["year"]; ?>

</span>

</td>


<td>

<a
href="edit.php?id=<?php echo $student["id"]; ?>"
class="btn btn-sm btn-warning">

Edit

</a>

<a
href="delete.php?id=<?php echo $student["id"]; ?>"
class="btn btn-sm btn-danger delete-btn">

Delete

</a>

</td>

</tr>

<?php

endwhile;

else:

?>

<tr>

<td
colspan="9"
class="text-center py-5">

<h5>
No students found
</h5>

<a
href="add.php"
class="btn btn-success">

+ Add Student

</a>

</td>

</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</div>

</div>


<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

<script
src="../assets/js/script.js">
</script>

</body>

</html>