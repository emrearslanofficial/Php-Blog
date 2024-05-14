<?php 
include("../database/db.class.php");
include("../database/blogs.class.php");

if(!isLoggedInAndAdmin()){
    header("Location: ../index.php");
    exit;
}

?>

<?php include('partials/header.php')?>

<?php include('partials/sidebar.php')?>
<?php include('partials/main.php')?>
<?php include('partials/main-end.php')?>
<?php include('partials/footer.php')?>