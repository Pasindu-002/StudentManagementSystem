<?php
require_once "../config/database.php";

$search = "";

if (isset($_GET["search"])) {
    $search = trim($_GET["search"]);
}

if ($search !== "") {

    $stmt = $conn->prepare(
        "SELECT * FROM students
         WHERE student_id LIKE ?
         OR full_name LIKE ?
         OR email LIKE ?
         OR course LIKE ?
         ORDER BY id DESC"
    );

    $searchValue = "%" . $search . "%";

    $stmt->bind_param(
        "ssss",
        $searchValue,
        $searchValue,
        $searchValue,
        $searchValue
    );

    $stmt->execute();

    $students = $stmt->get_result();

} else {

    $students = $conn->query(
        "SELECT * FROM students ORDER BY id DESC"
    );
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>View Students</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>Students</h2>
            <p class="text-muted">
                Manage student records
            </p>
        </div>

        <div>

            <a href="../dashboard.php" class="btn btn-secondary">
                Dashboard
            </a>

            <a href="add.php" class="btn btn-success">
                + Add Student
            </a>

        </div>

    </div>

    <?php if (isset($_GET["success"])): ?>

        <div class="alert alert-success">

            <?php

            if ($_GET["success"] === "added") {
                echo "Student added successfully.";
            }

            if ($_GET["success"] === "updated") {
                echo "Student updated successfully.";
            }

            if ($_GET["success"] === "deleted") {
                echo "Student deleted successfully.";
            }

            ?>

        </div>

    <?php endif; ?>

    <form method="GET" class="mb-4">

        <div class="input-group">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search by ID, name, email or course..."
                value="<?php echo htmlspecialchars($search); ?>"
            >

            <button class="btn btn-primary">
                Search
            </button>

            <a href="view.php" class="btn btn-secondary">
                Reset
            </a>

        </div>

    </form>

    <div class="card shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-primary">

                        <tr>

                            <th>ID</th>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Course</th>
                            <th>Year</th>
                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php if ($students->num_rows > 0): ?>

                        <?php while ($student = $students->fetch_assoc()): ?>

                            <tr>

                                <td>
                                    <?php echo $student["id"]; ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($student["student_id"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($student["full_name"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($student["gender"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($student["email"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($student["phone"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($student["course"]); ?>
                                </td>

                                <td>
                                    <?php echo $student["year"]; ?>
                                </td>

                                <td>

                                    <a
                                        href="edit.php?id=<?php echo $student['id']; ?>"
                                        class="btn btn-sm btn-warning"
                                    >
                                        Edit
                                    </a>

                                    <a
                                        href="delete.php?id=<?php echo $student['id']; ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this student?');"
                                    >
                                        Delete
                                    </a>

                                </td>

                            </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="9" class="text-center">
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