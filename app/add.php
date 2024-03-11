<?php
require '../db_conn.php';

if (isset($_POST['title'])) {

    $title = $_POST['title'];

    if (empty($title)) {
        header("Location: ../index.php?message=error");
    } else {
        $stmt = $conn->prepare("INSERT INTO todos(title) VALUES (?)");
        $res = $stmt->execute([$title]);

        // if res is true
        $res ? header("Location: ../index.php?message=success") : header("Location: ../index.php?message=error");

        $conn = null;
        exit();
    }
} else {
    header("Location: ../index.php?message=error");
}
