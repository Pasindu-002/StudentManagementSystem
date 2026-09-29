<?php

session_start();

require_once "config/database.php";

if (isset($_SESSION["user_id"])) {

    header("Location: dashboard.php");

    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($username === "" || $password === "") {

        $error = "Please enter username and password.";

    } else {

        $stmt = $conn->prepare(
            "SELECT id, username, password
             FROM users
             WHERE username = ?"
        );

        $stmt->bind_param(
            "s",
            $username
        );

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 1) {

            $user = $result->fetch_assoc();

            if (
                password_verify(
                    $password,
                    $user["password"]
                )
            ) {

                $_SESSION["user_id"] =
                    $user["id"];

                $_SESSION["username"] =
                    $user["username"];

                header(
                    "Location: dashboard.php"
                );

                exit();

            }

        }

        $error =
            "Invalid username or password.";
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
Login | Student Management System
</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="assets/css/style.css">

</head>

<body class="login-page">

<div class="container">

<div
class="row justify-content-center align-items-center min-vh-100">

<div class="col-md-5">

<div class="card login-card shadow-lg">

<div class="card-body p-5">

<div class="text-center mb-4">

<div class="login-icon">
🎓
</div>

<h2 class="fw-bold">
Student Management System
</h2>

<p class="text-muted">
Administrator Login
</p>

</div>

<?php if ($error !== ""): ?>

<div class="alert alert-danger">

<?php

echo htmlspecialchars($error);

?>

</div>

<?php endif; ?>

<form method="POST">

<div class="mb-3">

<label class="form-label">
Username
</label>

<input
type="text"
name="username"
class="form-control"
placeholder="Enter username"
required>

</div>

<div class="mb-4">

<label class="form-label">
Password
</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Enter password"
required>

</div>

<button
type="submit"
class="btn btn-primary w-100">

Login

</button>

</form>

<div class="alert alert-info mt-4 mb-0">

<strong>Demo Account</strong>

<br>

Username:
<strong>admin</strong>

<br>

Password:
<strong>admin123</strong>

</div>

</div>

</div>

</div>

</div>

</div>

</body>

</html>