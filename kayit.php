<?php include 'database/db.class.php'; include 'database/blogs.class.php'; ?>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $pass = $_POST["password"];
    $mail = $_POST["email"];

    $users = new User();
    if($users->createUsers($username,$name,$surname,$pass,$mail)){
        header("location: index.php");
    }else{
    header('Location: index.php');
    }
}
?>