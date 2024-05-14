<?php
include("../database/db.class.php");
include('../database/blogs.class.php');

if(isLoggedIn()){
    header('Location: /index.php');
}

$users = new User();
$userData = $users->getUsers();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $logReg = $_POST["register"];

    if($logReg == "register"){
        $username = $_POST["username"];
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $pass = $_POST["password"];
        $mail = $_POST["email"];

        $users = new User();
        if($users->createUsers($username,$name,$surname,$pass,$mail)){
            header("location: /index.php");
        }else{
        header('Location: login.php');
        }
    }elseif($logReg == "login"){
        $username = $_POST["usernameLog"];
        $password = $_POST["passwordLog"];

        foreach($userData as $user){
            if($user->username == $username && $user->password == $password){  
                $_SESSION["loggedIn"]=true;
                $_SESSION["id"]=$id;                           
                $_SESSION["username"]=$username;
                $_SESSION["role"]=$user->role;
                $_SESSION["name"] = $user->name;
                $_SESSION["surname"] = $user->surname;
                $_SESSION["image"] = $user->image;
                $_SESSION["id"]=$user->id;
        
                header("Location: /index.php");
        
            }else{
                header("Location: login.php");
            }
        }
    }
}


?>

<?php  include("../partials/_header.php"); ?>


<div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php  include("../partials/_navbar.php"); ?>
            <div class="container">
        <div class="card border-light-subtle shadow-sm my-5">
        <div class="row g-0">
            <div class="col-12 col-md-6">
                <div class="card-body p-3 p-md-4 p-xl-5">
                    <div class="row">
                    <div class="col-12">
                        <div class="mb-5">
                        <h3>Giriş Yap</h3>
                        </div>
                    </div>
                    </div>
                    <form action="" method="post">
                        <div class="row gy-3 gy-md-4 overflow-hidden">
                            <div class="col-12">
                                <label for="username" class="form-label">Kullanıcı Adı <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="usernameLog" id="username" required>
                            </div>
                            <div class="col-12">
                                <label for="password" class="form-label">Şifre <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="passwordLog" id="password" value="" required>
                                <input type="text" class="form-control" hidden name="register" id="register" value="login">
                            </div>
                            <div class="col-12">
                            <div class="d-grid">
                                <button class="btn bsb-btn-xl btn-primary" type="submit">Giriş Yap</button>
                            </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                    <div class="col-12">
                        <hr class="mt-5 mb-4 border-secondary-subtle">
                        <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                        <a href="#!" class="link-secondary text-decoration-none">Forgot password</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card-body p-3 p-md-4 p-xl-5">
                    <div class="row">
                    <div class="col-12">
                        <div class="mb-5">
                            <h3>Kayıt Ol</h3>
                        </div>
                    </div>
                    </div>
                    <form action="" method="post">
                        <div class="row gy-3 gy-md-4 overflow-hidden">
                            <div class="col-6">
                                <label for="name" class="form-label">Ad <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Ad" required>
                                <input type="text" class="form-control" hidden name="register" id="register" value="register">
                            </div>
                            <div class="col-6">
                                <label for="surname" class="form-label">Soyad <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="surname" id="surname" placeholder="Soyad" required>
                            </div>
                            <div class="col-6">
                                <label for="mail" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="mail" id="mail" placeholder="ornek@gmail.com" required>
                            </div>
                            <div class="col-6">
                                <label for="username" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Kullancı Adı" required>
                            </div>
                            <div class="col-12">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" id="password" value="" required>
                            </div>
                            <div class="col-12">
                            <div class="d-grid">
                                <button class="btn bsb-btn-xl btn-primary" type="submit">Kayıt Ol</button>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
        </div>
    </div>
</div>
