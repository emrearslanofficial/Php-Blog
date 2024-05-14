<?php
function uploadImage(array $file){
    if(isset($file)){
        $dest_path = "../../img/";
        $filename = $file["name"];
        $fileSourcePath = $file["tmp_name"];
        $fileDestPath = $dest_path.$filename;
        move_uploaded_file($fileSourcePath, $fileDestPath);
    }
}

?>