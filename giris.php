<?php
include 'database/db.class.php';
include 'database/blogs.class.php';
?>
<?php 

if(!isLoggedIn()){
    header('Location: /index.php');
}

$users = new User();
$userData = $users->getUsers(); // Kullanıcıları almak için getUsers() metodu çağrılıyor

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];
}


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

        header("Location:index.php");

    }else{
        header("Location:index.php");
    }
}

?>
