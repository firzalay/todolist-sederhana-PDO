<?php
require '../db_conn.php';

if (isset($_POST['id'])) {

    $id = $_POST['id'];

    if (empty($id)) {
        echo 'error';
    } else {
        $todos = $conn->prepare("SELECT id, checked FROM todos WHERE id = ? ");
        $todos->execute([$id]);

        $todo = $todos->fetch();
        $uId = $todo['id'];
        $checked = $todo['checked'];

        $uChecked = $checked ? 0 : 1;

        $res = $conn->query("UPDATE todos SET checked = $uChecked WHERE id = $uId");

        if ($res) {
            echo $checked;
        } else {
            echo 'error';
        }

        $conn = null;
        exit();
    }
} else {
    header("Location: ../index.php?message=error");
}
