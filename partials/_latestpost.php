<?php

    $blogs = new Blogs(); 
    $blogPosts = $blogs->getBlogs(); 
    $latestBlogs = $blogs->getLatestBlog4();

?>
<style>
    a{
        text-decoration: none;
        color: white;
    }
</style>

<div class="containerm m-5 my-5">
    <div class="row justify-content-center">
    <?php foreach($latestBlogs as $key => $lts): ?>
        <?php if ($key === 0): ?>
            <div class="col-6 col-xs-12">
                <div class="card rounded-1 h-100">
                    <a href="../pages/blog.php?id=<?php echo $lts->id; ?>" class="h-100">
                        <img src="../img/<?php echo $lts->image?>" class="card-img-top h-100" style="object-fit: cover;">
                        <div class="col-xs-12 card-body position-absolute bottom-0 start-0 bg-dark bg-opacity-50 w-100">
                            <h3><?php echo $lts->title?></h3>
                        </div>
                    </a>
                </div>
            </div>
            <?php elseif ($key === 1): ?>
                <div class="col-3">
                    <div class="card rounded-1 position-relative h-100">
                        <a href="../pages/blog.php?id=<?php echo $lts->id; ?>" class="h-100">
                            <img src="../img/<?php echo $lts->image?>" class="card-img-top h-100" style="object-fit: cover;">
                            <div class="card-body position-absolute bottom-0 start-0 bg-dark bg-opacity-50 w-100">
                                <h5><?php echo $lts->title?></h5>
                            </div>
                        </a>
                    </div>
                </div>
            <?php elseif($key === 2): ?>
                <div class="col-3">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="card rounded-1">
                                <a href="../pages/blog.php?id=<?php echo $lts->id; ?>" class="h-100">
                                    <img src="../img/<?php echo $lts->image?>" class="card-img-top h-100" style="object-fit: cover;">
                                    <div class="card-body position-absolute bottom-0 start-0 bg-dark bg-opacity-50 w-100">
                                        <h6><?php echo $lts->title?></h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php elseif($key === 3): ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card rounded-1">
                            <a href="../pages/blog.php?id=<?php echo $lts->id; ?>" class="h-100">
                                <img src="../img/<?php echo $lts->image?>" class="card-img-top h-100" style="object-fit: cover;">
                                <div class="card-body position-absolute bottom-0 start-0 bg-dark bg-opacity-50 w-100">
                                    <h6><?php echo $lts->title?></h6>
                                </div>
                            </a>
                            </div>
                        </div>
                    </div>

                </div>
            <?php endif; ?>
        <?php endforeach; ?> 
    </div>
</div><br><br><br>