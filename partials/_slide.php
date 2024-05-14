<?php
    $blogs = new Blogs(); 
    $blogPosts = $blogs->getBlogs(); 
?>


<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-7 mb-5">
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-inner">
                        <?php foreach ($blogPosts as $index => $blog): ?>
                                <div class="carousel-item <?php echo ($index === 0) ? 'active' : ''; ?>">
                                    <img src="/img/<?php echo $blog->image; ?>" class="d-block w-100 slideImg" style="height:400px" >
                                    <div id="caption" class="carousel-caption">
                                        <h5><?php echo $blog->title; ?></h5>
                                    </div>
                                </div>
                        <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" id="prevBtn" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" id="nextBtn" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>

<style>

    .carousel-caption{
        transition: 0.2;
        left: 0;
        bottom: 0;
        display: flex;
        justify-content: center; /* Yatayda ortala */
        align-items:end;
        width: 641px;
        height: 100px;
        color: white;
        background-color: rgb(0, 0, 0, 0.8);
    }

    .carousel-item {
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
    }

    .carousel-item.active {
        opacity: 1;
    }
</style>

<script>
    const prevBtn = document.querySelector("#prevBtn");
    const nextBtn = document.querySelector("#nextBtn");
    let index = 0;
    const totalImages = <?php echo count($blogPosts); ?>;

    prevBtn.addEventListener("click", function() {
        index = (index === 0) ? (totalImages - 1) : (index - 1);
        showSlide(index);
    });

    nextBtn.addEventListener("click", function() {
        index = (index === totalImages - 1) ? 0 : (index + 1);
        showSlide(index);
    });

    function showSlide(index) {
        const carouselItems = document.querySelectorAll('.carousel-item');
        carouselItems.forEach(function(item, i) {
            if (i === index) {
                item.classList.add('active');
                item.style.opacity = 0.5;
                setTimeout(function() {
                    item.style.opacity = 1;
                },10); // Animasyon başlangıç süresi her slayt için biraz geciktirilecek
            } else {
                item.classList.remove('active');
                item.style.opacity = 0;
            }
        });
    }

    setInterval(function() {
        index = (index === totalImages - 1) ? 0 : (index + 1);
        showSlide(index);
    }, 3000);



</script>

