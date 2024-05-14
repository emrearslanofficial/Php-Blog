<?php
include("../../database/db.class.php");
include("../../database/blogs.class.php");
if(!isLoggedInAndAdmin()){
    header("Location: ../index.php");
    exit;
}

$data = array();

if(isset($_FILES['upload']['name'])){
    $file_name = $_FILES['upload']['name'];
    $file_path = 'img/'.$file_name;
    $file_extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
    if($file_extension == 'jpg' || $file_extension == 'png' || $file_extension == 'jpeg'){
        if(move_uploaded_file($_FILES['upload']['tmp_name'], $file_path)){
            $data['file'] = $file_name;
            $data['url'] = $file_path;
            $data['uploaded'] = 1;
        }else{
            $data['uploaded'] = 0;
            $data['error']['message'] = 'Hata';
        }
    }else{
        $data['uploaded'] = 0;
        $data['error']['message'] = 'Bulunamadı';
    }
}
echo json_encode($data);
?>