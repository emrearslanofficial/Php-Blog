<?php
$blogs = new Blogs();
$blogPosts = $blogs->getBlogs();
$category = new Category();
?>

<div class="container">
        <div class="row h-50">  
            <?php foreach($blogPosts as $blog): ?>
                <div class="col-md-6 mb-5">
                    <div class="card border-0 shadow-lg bg-body-tertiary">
                        <div class="row no-gutters">
                            <div class="col-md-6">
                                <a href="../pages/blog.php?id=<?php echo $blog->id; ?>"><img src="/img/<?php echo $blog->image;?>" class="card-img-top resim"></a>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                <h6 class="card-text">
                                <a href="../pages/blog.php?id=<?php echo $blog->id; ?>" style="color:#1C1D1F;">
                                    <?php
                                        $title = $blog->title;
                                        $short_title = strlen($title) > 110 ? substr($title, 0, 110) . '...' : $title;
                                        echo $short_title;
                                    ?>
                                </a>
                                </h6>
                                <h6 class="text-right" style="color:gray;position: absolute; bottom: 5px; right: 12px; font-size:small;">
                                    <?php 
                                        $blogCatId = $blog->category_id;
                                        $categories = $category->getCategoryById($blogCatId);
                                        if (isset($categories->category_name)) {
                                            echo $categories->category_name;
                                        } else {
                                            echo 'Kategori adı mevcut değil';
                                        }   
                                    ?>
                                </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
</div>
<?php include './partials/_footer.php'; ?>