<?php
$category = new Category();
$categories = $category->getCategory();

?>

<style>
    .social a{
        color: white;
    }
    .footerYazi{
        font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
</style>

<footer class="footer bg-dark text-white text-center py-3">
    <div class="container">
                <div class="footer-icerik d-flex align-content-center justify-content-between">
                    <div class="social">
                        <a href="#"><i class="fa-brands fa-instagram fa-lg mx-2"></i></a>
                        <a href="#"><i class="fa-brands fa-facebook fa-lg mx-2"></i></a>
                        <a href="#"><i class="fa-brands fa-x-twitter fa-lg mx-2"></i></a>
                        <a href="#"><i class="fa-brands fa-youtube fa-lg mx-2"></i></a>
                        <a href="#"><i class="fa-brands fa-pinterest fa-lg mx-2"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin fa-lg mx-2"></i></a>
                    </div>
                </div>
        <span class="footerYazi" >© 2024 <b>Emre Arslan.</b> &copy; Tüm Hakları Saklıdır.</span>
    </div>
</footer>
</body>
</html>