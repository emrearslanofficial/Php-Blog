<?php 
include("../../database/db.class.php");
include("../../database/blogs.class.php");

if(!isLoggedInAndAdmin()){
    header("Location: ../index.php");
    exit;
}

$user = new User();

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $users = $user->getUsersById($id);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $mail = $_POST["mail"];
    $biography = $_POST["biography"];
    $role = $_POST["role"];

    if($user->editUsersByAdmin($id,$username,$name,$surname,$mail,$biography,$role)){
        header("location: ");
    }
}



?>

<script src="../../editor/build/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-LgV+8OIvaNDJ4qaVRr8p6mBtYXdzXan9/PMz8axkJvVqznY5CxV+q4wYwAIi/kyS" crossorigin="anonymous"></script>

<?php include('../partials/header.php')?>
<?php include('../partials/sidebar.php')?>
<?php include('../partials/main.php')?>


<div class="col-lg-12">
<form action="" method="post">
                                <div class="card">
                                    <div class="card-header pb-0">
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0">Kullanıcı Düzenle</p>
                                    </div>
                                    </div>
                                    <div class="card-body text-dark font-weight-bold">
                                    <p class="text-uppercase text-sm">Kullanıcı bilgileri</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Kullanıcı Adı</label>
                                            <input class="form-control" type="text" name="username" value="<?php echo $users->username;?>">
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Mail Adresi</label>
                                            <input class="form-control" type="email" name="mail" value="<?php echo $users->mail;?>">
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Ad</label>
                                            <input class="form-control" type="text" name="name" value="<?php echo $users->name;?>">
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Soyad</label>
                                            <input class="form-control" type="text" name="surname" value="<?php echo $users->surname;?>">
                                        </div>
                                        </div>
                                    </div>
                                    <hr class="horizontal dark">
                                    <p class="text-uppercase text-sm">Kullanıcı Rolü</p>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Rol</label>
                                                <input class="form-control" type="text" name="role" value="<?php echo $users->role;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="horizontal dark">
                                    <p class="text-uppercase text-sm">Biyografi</p>
                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Hakkında</label>
                                            <input class="form-control" type="text" name="biography" value="<?php echo $users->biography;?>">
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="card-footer">
                                    <button class="btn btn-success w-100 m-2 p-2" type="submit">Bilgileri Güncelle</button>
                                </div>
                                </div>
                            </form>
</div>



<?php include('../partials/main-end.php')?>
<?php include('../partials/footer.php')?>