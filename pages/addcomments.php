<div class="row py-4">
    <div class="col-md-1 mx-1 d-flex justify-content-end">
            <div class="profile-pic rounded-5">
                <?php if(isset($_SESSION["loggedIn"])):?>
                <img src="../<?php echo $_SESSION["image"]?>" class="card-image img-fluid rounded-4 h-100 w-100">
                <?php else:?>
                <img src="../img/pp.png" class="card-image img-fluid rounded-4 h-100 w-100">
                <?php endif?>
            </div>
    </div>
    <div class="col-10">
        <form action="commentadd.php" method="post">
            <?php if(!isset($_SESSION["loggedIn"])):?>
                <div class="input-group w-50">
                    <input type="hidden" name="blog_id" value="<?php echo $blogPosts->id; ?>">
                    <textarea class="form-control w-100" name="content" disabled placeholder="Yorumunuzu yazın"></textarea>
                    <div class="yorumBtn w-100 d-flex align-items-center justify-content-end">
                        <p class="text-danger">Yorum yazmak için giriş yapmanız gerekiyor.</p>
                        <button type="submit" disabled class="mx-1 btn btn-danger p-2 my-3 yorumBtn">Yorumu Gönder</button>
                    </div>
                </div>
            <?php else:?>
                <div class="input-group w-50">
                    <input type="hidden" name="blog_id" value="<?php echo $blogPosts->id; ?>">
                    <textarea class="form-control w-100" name="content" placeholder="Yorumunuzu yazın"></textarea>
                    <div class="yorumBtn w-100 d-flex align-items-center justify-content-end">
                        <button type="submit" class="mx-1 btn btn-danger p-2 my-3 yorumBtn">Yorumu Gönder</button>
                    </div>
                </div>    
            <?php endif?>
        </form>
    </div>
</div>

<?php

$comment = new Comments();
$comments = $comment->getComments();
$user = new User();

?>

<div class="row py-4">
    <h3 class="mx-3 text-danger-emphasis">Yorumlar ( )</h3>
    
    <div class="container my-3 mx-5">
        <div class="row d-flex justify-content-start">
        <div class="col-md-12 col-lg-7">
            <div class="card text-body border-0">
                <?php foreach($comments as $com):?>
                    <?php if($blogPosts->id ==  $com->blog_id): ?>
                        <div class="card-body p-2">
                            <div class="d-flex flex-start">
                            <img class="rounded-circle shadow-1-strong me-3"
                                src="../<?php $blgUsId = $user->getUsersById($com->user_id); echo $blgUsId->image?>" alt="avatar" width="60"
                                height="60" />
                            <div>
                                <h6 class="fw-bold mb-1"><?php $blgUsId = $user->getUsersById($com->user_id); echo $blgUsId->name?></h6>
                                <div class="d-flex align-items-center mb-3">
                                <p class="mb-0 badge text-bg-danger rounded-0"><?php echo date("F j, Y", strtotime($com->time)); ?></p>
                                </div>
                                <p class="mb-0"><?php echo $com->content; ?></p>
                            </div>
                            </div>
                        </div>
                        <br>
                    <?php endif ?>
            <?php endforeach?>
            </div>
        </div>
        </div>
    </div>

</div>



<style>
    .profile-pic {
    height: 50px;
    width: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    }

    .profile-pic img {
        object-fit: cover;
        height: 100%;
        width: 100%;
    }
</style>

<script src="../assets/app.js"></script>