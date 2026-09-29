<?php

session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: ../login.php");

    exit();
}

require_once "../config/database.php";


$id =
    filter_input(
        INPUT_GET,
        "id",
        FILTER_VALIDATE_INT
    );


if (!$id) {

    header("Location: view.php");

    exit();
}


$stmt = $conn->prepare(
    "DELETE FROM students WHERE id = ?"
);

$stmt->bind_param(
    "i",
    $id
);

$stmt->execute();


header(
    "Location: view.php?success=deleted"
);

exit();

?>