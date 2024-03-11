<?php
require '../db_conn.php';

if (isset($_POST['id'])) {

    $id = $_POST['id'];

    if (empty($id)) {
        echo 0;
    } else {
        $stmt = $conn->prepare("DELETE FROM todos WHERE id = ?");
        $res = $stmt->execute([$id]);

        // if res is true
        if ($res) {
            echo 1;
        } else {
            echo 0;
        }

        $conn = null;
        exit();
    }
} else {
    header("Location: ../index.php?message=error");
}
