<?php
    $blogs = new Blogs();
    $category = new Category();
    $categories = $category->getCategory();
    $blogPosts = $blogs->getBlogs(); 
    $latestBlogs = $blogs->getLatestBlogs();


    $sonYaziBasliklar = array();
    $sonYaziBasliklarId = array();
    for ($i = max(0, count($blogPosts) - 5); $i < count($blogPosts); $i++) {
        $sonYaziBasliklar[] = $blogPosts[$i]->title;
        $sonYaziBasliklarId[] = $blogPosts[$i]->id;
    }
    
    $sonYazilar = json_encode($sonYaziBasliklar);
    $yaziId = json_encode($sonYaziBasliklarId);
    
    echo '
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const aElementi = document.querySelector(".ahrf");
        if (aElementi) {
            const sonYaziBasliklar = ' . $sonYazilar . ';
            const yaziId = ' . $yaziId . ';
            

            const baslikIdEsinleri = {};
            for (let i = 0; i < sonYaziBasliklar.length; i++) {
                baslikIdEsinleri[sonYaziBasliklar[i]] = yaziId[i];
            }
            
            const hrefDegeri = "../pages/blog.php?id=" + baslikIdEsinleri[sonYaziBasliklar[0]];
            aElementi.setAttribute("href", hrefDegeri);

            aElementi.innerHTML = `
                <span id="sonYaziBasliklar"></span>
            `;

            const spanIcerik = document.getElementById("sonYaziBasliklar");
            let index = 0;

            function baslikDegistir() {
                spanIcerik.innerText = sonYaziBasliklar[index];
                const hrefDegeri = "../pages/blog.php?id=" + baslikIdEsinleri[sonYaziBasliklar[index]];
                aElementi.setAttribute("href", hrefDegeri);
                index = (index + 1) % sonYaziBasliklar.length;
            }
            baslikDegistir();
            setInterval(baslikDegistir, 2000);
        }
    });
</script>
';
?>
<script src="assets/app.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-lg p-3 mb-0">
        <a class="navbar-brand" href="/">Emmedya</a>
    <div class="container">
        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link active" href="#">Anasayfa</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Kategoriler
                </a>
                <ul class="dropdown-menu rounded-0">
                    <?php foreach($categories as $cat):?>
                        <li><a class="dropdown-item" href="/pages/categories.php?id=<?php echo $cat->id?>"><?php echo $cat->category_name?></a></li>
                    <?php endforeach?>
                </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="/pages/about.php">Hakkımızda</a></li>
            <li class="nav-item"><a class="nav-link" href="/pages/contact.php">İletişim</a></li>
            <li class="nav-item"><a class="nav-link" href="/pages/social.php">Sosyal Ağ</a></li>
        </ul>
        <ul class="navbar-nav">
                <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-search h6"></i></a></li>
        </ul>
        <?php if(isLoggedIn()):?>
            <ul class="navbar-nav">
                <li class="nav-item"><img id="profileModalButton" data-toggle="modal" data-target="#profileModal" class="img-profile rounded-circle mx-3" style="height: 25px; width:25px;cursor:pointer;" src="/<?php echo $_SESSION["image"]?>"></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a style="color:#1C1D1F; text-decoration:none;" href="/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a></li>
            </ul>
        <?php else: ?>
            <ul class="navbar-nav">
                <a style="color:#1C1D1F; text-decoration:none;" href="/pages/login.php"><li class="nav-item"><i class="bi bi-person-fill h5"></i></li></a>
            </ul>
        <?php endif; ?>
    </div>
</nav>

<div class="profileModalDiv">
    
</div>

<script>
    const profileModalButton = document.getElementById("profileModalButton");
    const profileModalDiv = document.querySelector(".profileModalDiv");

profileModalButton.addEventListener("click", () => {
    console.log("Tıklandı");
    profileModalDiv.innerHTML = `
        <div class="modal fade modalım" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="profileModalLabel">Merhaba, <?php echo $_SESSION["name"]?></h1>
                    <button type="button" id="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class=" d-flex justify-content-center">
                        <img class="rounded" style="height:105px; width:100px;" src="../../<?php echo $_SESSION["image"]; ?> ">
                    </div>
                    <div class="mt-3 d-flex justify-content-center">
                        <h4 class="text-muted text-danger-emphasis" ><?php echo $_SESSION["username"]; ?></h4>
                    </div>
                    <div class="d-flex flex-column justify-content-center mt-3">
                        <a href="../pages/profile.php"><button type="submit" name="username" class="form-control mb-2 w-100 btn btn-outline-dark">Profili Düzenle</button></a>
                        <?php if($_SESSION["role"] == "admin"):?>
                        <a href="../admin"><button type="submit" name="username" class="form-control w-100 btn btn-outline-danger">Admin Panel</button></a>
                        <?php endif?>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="/logout.php"><button type="button" class="btn"><i class="fa-solid fa-right-from-bracket"></i></button></a>
                </div>
                </div>
            </div>
        </div>
    `;

    closeModal();
    function closeModal(){
        document.querySelector('#close').addEventListener('click', () => {
            document.querySelector('.modalım').classList.remove('show');
            document.body.classList.remove('modal-open');
            document.querySelector('.modal-backdrop').remove(); 
        });
    }
});
</script>


<nav class="navbar navbar-expand-sm bg-dark sonYazi" style="color:white;">
    <span class="baslik mx-3">Son Yazılar</span>
    <a id="aHref" class="ahrf"><span id="sonYaziBasliklar"></span></a>
</nav>

<style>
    #aHref{
        color:white;
        text-decoration: none;
        font-weight: normal;
        font-size: 15px;
    }
    .dropdown-menu .dropdown-item:hover {
        background-color: #343a40; /* Koyu mavi arka plan rengi */
        color: #ffffff; /* Beyaz metin rengi */
    }
    .dropdown-menu .dropdown-item:active {
    background-color: #0D3E88; /* Koyu mavi arka plan rengi */
    color: #ffffff; /* Beyaz metin rengi */
    }
</style>


<nav class="navbar navbar-expand-sm bg-light shadow-lg">
    <i class="fa-solid fa-dollar-sign mx-3"></i><span id="dollar"></span>
    <span id="usdArrow" class="fa-solid"></span>

    <i class="fa-solid fa-euro-sign mx-3"></i><span id="euro"></span>
    <span id="eurArrow" class="fa-solid"></span>

    <i class="fa-brands fa-bitcoin mx-3"></i><span id="btc"></span>
    <span id="btcArrow" class="fa-solid"></span>

</nav>




<style>
    .sonYazi{
        font-weight: bold;
        transition: 0.2s;
    }
    .sonYazi:hover{
        color: #FF2D39;
    }
    #sonYaziBasliklar{
        transition: 0.2s;
        cursor: pointer;
    }
    #sonYaziBasliklar:hover{
        color: #FF2D39;
    }
</style>


<script>
    const api_key = "";
    const url = "https://v6.exchangerate-api.com/v6/" + api_key;

    function getExchange(url){
        fetch(url + "/latest/" + "TRY")
            .then(res=>res.json())
            .then(data=>{
                const TRY = data.conversion_rates.TRY;
                const USD = (TRY / data.conversion_rates.USD).toFixed(3).toString();
                const EUR = (TRY / data.conversion_rates.EUR).toFixed(3);
                // setExchange(USD,EUR);
                const dollar = document.querySelector("#dollar");
                const euro = document.querySelector("#euro");
                dollar.textContent = USD;
                euro.textContent= EUR;

                const usdArrow = document.querySelector("#usdArrow");
                const eurArrow = document.querySelector("#eurArrow");

                prevUSD = USD;
                prevEUR = EUR;
                console.log(prevUSD);

                // USD ARTIŞ DÜŞÜŞ KONTROL

                if(USD >= prevUSD){
                    usdArrow.style.color = "green";
                    usdArrow.classList.add("fa-angle-up");
                    usdArrow.classList.remove("fa-angle-down");
                }
                else if(USD < prevUSD){
                    usdArrow.style.color = "red";
                    usdArrow.classList.add("fa-angle-down");
                    usdArrow.classList.remove("fa-angle-up");
                }


                // EUR ARTIŞ DÜŞÜŞ KONTROL

                if(EUR >= prevEUR){
                    eurArrow.style.color = "green";
                    eurArrow.classList.add("fa-angle-up");
                    eurArrow.classList.remove("fa-angle-down");
                }
                
                else if(EUR < prevEUR){
                    eurArrow.style.color = "red";
                    eurArrow.classList.add("fa-angle-down");
                    eurArrow.classList.remove("fa-angle-up");
                }

            });           
    }

    getExchange(url);

    setInterval(function() {
        getExchange(url);
    }, 60000);


    //BTC

    const btcUrl = "";
    fetch(btcUrl)
        .then(res=>res.json())
        .then(data=>{   
            const btcValue = (data.bitcoin.try);
            const btcElement = document.getElementById("btc");
            btcElement.innerText = btcValue;

            const btcArrow = document.querySelector("#btcArrow");

            prevBTC = btcValue;

            if(btcValue >= prevBTC){
                    btcArrow.style.color = "green";
                    btcArrow.classList.add("fa-angle-up");
                    btcArrow.classList.remove("fa-angle-down");
                }  
                else if(btcValue < prevBTC){
                    btcArrow.style.color = "red";
                    btcArrow.classList.add("fa-angle-down");
                    btcArrow.classList.remove("fa-angle-up");
                }
        });

</script>



<div class="loginModalDiv">
    
</div>


<script src="assets/app.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
