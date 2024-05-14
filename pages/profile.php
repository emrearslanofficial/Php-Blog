<?php
include("../database/db.class.php");
include('../database/blogs.class.php');
if(!isLoggedIn()){
    header('Location: /index.php');
}

$user = new User();
$post = new Posts();
$posts = $post->getPosts();

if(isset($_SESSION["id"])){
    $id = $_SESSION["id"];
    $users = $user->getUsersById($id);
}


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $mail = $_POST["mail"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $mail = $_POST["mail"];
    $password = $_POST["password"];
    $biography = $_POST["biography"];



    if($user->editUsers($id,$username,$name,$surname,$password,$mail,$biography)){
        $_SESSION["loggedIn"]=true;
        $_SESSION["id"]=$id;                           
        $_SESSION["username"]=$username;
        $_SESSION["role"]=$users->role;
        $_SESSION["name"] = $name;
        $_SESSION["surname"] = $surname;
        $_SESSION["image"] = $users->image;
        $_SESSION["biography"] = $users->$biography;
        $_SESSION["id"]=$users->id;

        header("location: profile.php");

    }
}

?>

<?php  include("../partials/_header.php"); ?>

<div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
                <?php  include("../partials/_navbar.php"); ?>

                <div class="row my-3 mx-5">
                <?php if(isLoggedIn()):?>
                        <div class="col-md-8">
                        <div class="card">
                            <form action="" method="post">
                                <div class="card-header pb-0">
                                <div class="d-flex align-items-center">
                                    <p class="mb-0">Edit Profile</p>
                                </div>
                                </div>
                                <div class="card-body text-dark font-weight-bold">
                                <p class="text-uppercase text-sm">Kullanıcı bilgileri</p>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Kullanıcı Adı</label>
                                        <input name="username" class="form-control" type="text" value="<?php echo $users->username;?>">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Mail Adresi</label>
                                        <input class="form-control" name="mail" type="email" value="<?php echo $users->mail;?>">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Ad</label>
                                        <input class="form-control" name="name" type="text" value="<?php echo $users->name;?>">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Soyad</label>
                                        <input class="form-control" name="surname" type="text" value="<?php echo $users->surname;?>">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="form-control-label">Şifre</label>
                                        <input class="form-control" name="password" type="password">
                                    </div>
                                    </div>
                                </div>
                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">Biyografi</p>
                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Hakkında</label>
                                            <input class="form-control" name="biography" type="text" value="<?php echo $users->biography;?>">
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-success w-100 m-2 p-2" type="submit">Bilgileri Güncelle</button>
                                </div>
                            </form>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="card card-profile align-items-center justify-content-center w-100">
                            <img src="/<?php echo $users->image;?>" style="height:200px; width:200px;" alt="Image placeholder" class="card-img-top">
                            <div class="row justify-content-center">
                            <div class="col-4 col-lg-4 order-lg-2">
                                <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                </div>
                            </div>
                            </div>
                            <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                            <div class="d-flex justify-content-between">
                            </div>
                            </div>
                            <div class="card-body pt-0">
                            <div class="row">
                                <div class="col">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="d-grid text-center">
                                            <span class="text-lg font-weight-bolder">61</span>
                                            <span class="text-sm opacity-8">Takipçi</span>
                                        </div>
                                        <div class="d-grid text-center m-2">
                                            <span class="text-lg font-weight-bolder">61</span>
                                            <span class="text-sm opacity-8">Takip Edilen</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <h5>
                                <?php echo $users->name ." ". $users->surname;?><span class="font-weight-light"></span>
                                </h5>
                                <div class="h6 font-weight-300">
                                <i class="ni location_pin mr-2"></i>İstanbul, Türkiye
                                </div>
                                <div class="h6 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>Front-End Developer - Emmedya
                                </div>
                                <div>
                                <i class="ni education_hat mr-2"></i>Karabük Üniversitesi
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <?php else:?>
                            <div class="col-md-12">
                                <div class="alert alert-danger" role="alert">Bu sayfaya giriş yetkiniz yok! <br> Lütfen hesabınız varsa giriş yapın yoksa kayıt olabilirsiniz.</div>
                            </div>
                        <?php endif?>
                </div>
        </div>
    </div>
</div>

<style>

    .yorum,.rt,.begeni,.paylas{
        font-size: 18px;
    }

    .yorum:hover{
        transition: all 0.3s ease;;
        transform: scale(1.2);
        color: rgb(29, 155, 240);
    }
    .rt:hover{
        transition: all 0.3s ease;;
        transform: scale(1.2);
        color: #43DE3A;
    }
    .begeni:hover{
        transition: all 0.3s ease;;
        transform: scale(1.2);
        color: #FF2D39;
    }
    .paylas:hover{
        transition: all 0.3s ease;;
        transform: scale(1.2);
        color: rgb(29, 155, 240);
    }
    .custom-shadow {
    box-shadow: 0 0 20px rgba(13, 62, 136, 0.5); /* Burada kırmızı bir gölge tanımladık */
}
</style>

<?php  include "../partials/_footer.php"; ?>