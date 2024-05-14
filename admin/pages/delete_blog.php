<?php
include("../../database/db.class.php");
include('../../database/blogs.class.php');

if(!isLoggedInAndAdmin()){
    header("Location: ../index.php");
    exit;
}

?>
<?php
    $blogs = new Blogs();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST["id"];

        if($blogs->deleteBlog($id)){
            header("location: /admin/pages/blogs.php");
        }
    }

?>