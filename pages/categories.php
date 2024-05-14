<?php

if(!isset($_GET["id"])){
    header('Location: /index.php');
}
include '../database/db.class.php';
include '../database/blogs.class.php';

$blogs = new Blogs();
$blogPosts = $blogs->getBlogs();
$category = new Category();
$blogCat = $_GET["id"];
$cats = $category->getCategoryById($blogCat);


?>
<?php include '../partials/_header.php'; ?>

<?php include '../partials/_navbar.php'; ?>


<div class="container">
    <div class="row" style="background-color:#F7F8FB;">
        <h3 class="mt-5 font-weight-bolder" style="color:#0D3E88;"><?php echo $cats->category_name?></h3>
        <div class="col-md-8">
            <?php foreach($blogPosts as $blg):?>
                <?php if($blogCat == $blg->category_id):?>
                    <div class="card border-0 my-5" style="background-color:#F7F8FB;">
                        <div class="row no-gutters">
                            <div class="col-md-5">
                                <a href="/pages/blog.php?id=<?php echo $blg->id; ?>"><img src="/img/<?php echo $blg->image?>" class="card-img-top rounded-0 resim"></a>
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h5 class="card-text">
                                        <a href="/pages/blog.php?id=<?php echo $blg->id; ?>" style="color:#1C1D1F;text-decoration:none;">
                                            <?php echo $blg->title?>
                                        </a>
                                    </h5>
                                    <h6 class="text-right" style="color:gray;position: absolute; bottom: 5px; right: 12px; font-size:small;">
                                    <i class="fa-solid fa-calendar-days"></i> <?php echo $blg->time?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif?>
            <?php endforeach?>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>


<script src="../../assets/app.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>