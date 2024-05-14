<?php
include '../database/db.class.php';
include '../database/blogs.class.php';

if(!isLoggedIn()){
    header('Location: /index.php');
}

$comment = new Comments();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $content = $_POST["content"];
    $userid = $_SESSION["id"];
    $blogid = $_POST['blog_id'];

    if($comment->addComments($content,$blogid,$userid)){
        header("Location: blog.php?id="."$blogid");
    }
}


?>