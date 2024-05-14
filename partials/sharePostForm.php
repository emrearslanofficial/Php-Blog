<form action="" method="post">
    <div class="dekor w-75" style="height: 10px; background-color:#0D3E88; margin-left:110px;"></div>
    <div class="card border-0 p-3 w-75 mb-3 shadow-lg" style="left:110px;">
        <div class="row">
            <div class="col-md-2">
                <div class="card-image border-2 rounded-circle" style="height:65px;width:65px;">
                    <img src="/<?php echo $_SESSION["image"]?>" class="w-100 h-100 rounded-circle" style="object-fit: cover;" alt="" />
                </div>
            </div>
            <div class="col-md-10">
                <div class="post">
                    <textarea class="form-control border-0 border-bottom" name="content" style="resize: none;" id="" rows="3" placeholder="Bugün nasıl hissediyorsun?"></textarea>
                </div>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-dark btn-sm">Paylaş</button>
            </div>
        </div>
    </div>
</form>