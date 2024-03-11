<?php 
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "belajar_todolist_php"; 

try {
    $conn = new PDO("mysql:host=$server_name;dbname=$db_name", $user_name, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    echo "Connection failed : " . $error->getMessage();
}

?>