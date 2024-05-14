<?php
include("../database/db.class.php");
include('../database/blogs.class.php');
if(!isLoggedIn()){
    header('Location: /index.php');
}

$user = new User();
$post = new Posts();
$posts = $post->getPosts();

if(isset($_SESSION["id"])){
    $id = $_SESSION["id"];
    $users = $user->getUsersById($id);
}


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $content = $_POST["content"];

    if($post->createPosts($content, $id)){
        header("location: social.php");
    }
}

?>

<?php  include("../partials/_header.php"); ?>

<div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
                <?php  include("../partials/_navbar.php"); ?>

            <div class="container-fluid py-4">
                    <div class="row mx-5">
                        <div class="col-md-8">
                            <?php include('../partials/sharePostForm.php');?>
                            <?php include('posts.php');?>
                        </div>
                        <div class="col-4">
                            <div class="card w-75 bg-dark custom-shadow">
                                <div class="row">
                                    <div class="col-md-12 mt-3 d-flex justify-content-center align-items-center">
                                        <div class="card-image border-4 border border-light rounded-circle" style="height:85px;width:85px;">
                                            <img src="/<?php echo $_SESSION["image"]?>" class="w-100 h-100 rounded-circle" style="object-fit: cover;" alt="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 d-flex align-items-center justify-content-center">
                                        <div class="text-light text-center">
                                            <h5><?php echo $_SESSION["name"]?></h5>
                                            <p style="font-size:10px;">Software Developer</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-flex align-items-center justify-content-center">
                                        <div class="text-light text-center">
                                            <h5>Takipçi</h5>
                                            <span class="badge text-bg-light">45</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3 my-5">
                                    <div class="col-md-12 d-flex align-items-center justify-content-center">
                                        <div class="text-light text-center">
                                            <h5>Takip Edilenler</h5>
                                            <span class="badge text-bg-light">45</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<style>

    .yorum,.rt,.begeni,.paylas{
        font-size: 18px;
    }

    .yorum:hover{
        transition: all 0.3s ease;;
        transform: scale(1.2);
        color: rgb(29, 155, 240);
    }
    .rt:hover{
        transition: all 0.3s ease;;
        transform: scale(1.2);
        color: #43DE3A;
    }
    .begeni:hover{
        transition: all 0.3s ease;;
        transform: scale(1.2);
        color: #FF2D39;
    }
    .paylas:hover{
        transition: all 0.3s ease;;
        transform: scale(1.2);
        color: rgb(29, 155, 240);
    }
    .custom-shadow {
    box-shadow: 0 0 20px rgba(13, 62, 136, 0.5); /* Burada kırmızı bir gölge tanımladık */
}
</style>

<?php  include "../partials/_footer.php"; ?>