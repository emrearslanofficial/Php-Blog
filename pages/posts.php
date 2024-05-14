<?php foreach($posts as $pos):?>
<div class="card border-0 rounded-1 mb-1 p-3 w-75 shadow-lg" style="left:110px;">
    <div class="row">
        <div class="col-md-2">
            <div class="card-image border-2 rounded-circle" style="height:65px;width:65px;">
                <img src="/<?php $posUsId = $user->getUsersById($pos->user_id); echo $posUsId->image?>" class="w-100 h-100 rounded-circle" style="object-fit: cover;" alt="" />
            </div>
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-4"><h6><?php echo $posUsId->name ." ". $posUsId->surname?></h6></div>
                <div class="col-md-4"><p class="text-muted" style="font-size:13px;margin-left:-70px;">@<?php echo $posUsId->username?></p></div>
                <div class="col-md-4">
                    <p class="text-muted" style="font-size:13px;margin-left:-150px;">
                    <?php
                        $created_at = new DateTime($pos->date);
                        $current_time = new DateTime();
                        $interval = $current_time->diff($created_at);
                        $total_minutes_diff = $interval->days * 24 * 60 + $interval->h * 60 + $interval->i;

                        if ($total_minutes_diff < 60) {
                            echo 60- $total_minutes_diff . " dakika önce";
                        } elseif ($total_minutes_diff < 1440) {
                            echo floor($total_minutes_diff / 60) . " saat önce";
                        } else {
                            echo floor($total_minutes_diff / 1440) . " gün önce";
                        }
                        ?>
                    </p>
                </div>  
            </div>
            <div class="row">
                <p>
                <?php echo $pos->content?>
                </p>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between">
            <i class="fa-regular fa-comment yorum"></i>
            <i class="fa-solid fa-retweet rt"></i>
            <i class="fa-regular fa-heart begeni"></i>
            <i class="fa-regular fa-share-from-square paylas"></i>
        </div>
    </div>
</div>
<?php endforeach?>