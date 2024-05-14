<?php
if(!isset($_GET["id"])){
    header('Location: /index.php');
}
?>
<?php
include '../database/db.class.php';
include '../database/blogs.class.php';
?>
<?php include '../partials/_header.php'; ?>
<?php include '../partials/_navbar.php'; ?>

<?php

$category = new Category();


    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if ($id !== null && is_numeric($id)){
        $blog = new Blogs();
        $blogPosts = $blog->getBlogsById($id);
        $blogCatId = $blogPosts->category_id;
        $categories = $category->getCategoryById($blogCatId);
        $latestBlogs = $blog->getLatestBlogs();
    }
    
?>

<style>
    .latestTitle{
        text-decoration: none;
        color: #1C1D1F;
        transition: 0.3s;
    }
    .latestTitle:hover{
        color: #0D3E88;
    }

</style>

<div class="container my-5">
    <div class="card border-0 rounded-1">
        <div class="row p-4">
            <div class="col-md-8">
                    <h2><?php echo $blogPosts->title; ?></h2>
                    <span class="badge text-bg-dark p-2"><?php echo $categories->category_name;?></span>
                    <hr>
                    <div class="blogIcerik"><?php echo $blogPosts->content;?></div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <?php include('latest.php');?>
                </div>

            </div>
        </div>
        <!--Yorum Bölümü-->
        <div class="row py-4">
            <?php include('addcomments.php')?> 
        </div>
    </div>
</div>

<?php include '../partials/_footer.php'; ?>
<style>
    .blogIcerik{
        width: 100%;
    }
    .blogIcerik img{
        width: 100%;
        height: auto;
        display: block; /* Resimlerin yan yana değil, alt alta sıralanmasını sağlar */
        margin: 0 auto;
    }
</style>



