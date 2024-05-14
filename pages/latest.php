<div class="card border-0 m-0 w-100">
                        <div class="row">
                            <div class="col-1 my-2 mx-2"><i class="fa-regular fa-newspaper fa-xl"></i></div>
                            <div class="col-9"><h3 class="text-dark-emphasis">En Yeni Yazılar</h3></div>
                        </div>
                        <div class="card-body">
                            <?php foreach($latestBlogs as $latests): ?>
                                <div class="row mb-3">
                                    <div class="col-1"><i class="fa-solid fa-feather text-light-emphasis"></i></div>
                                    <div class="col-11 mx-4 w-100">
                                        <div class="row"><span class="badge text-bg-danger w-25 rounded-0"><?php echo $category->getCategoryById($latests->category_id)->category_name;?></span></div>
                                        <div class="row my-1">
                                            <div class="col-12">
                                                <a href="blog.php?id=<?php echo $latests->id?>" class="latestTitle w-100">
                                                    <p class="fw-medium"><?php echo $latests->title?></p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach?>
                        </div>
                    </div>