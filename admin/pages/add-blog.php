<?php 
include("../../database/db.class.php");
include("../../database/blogs.class.php");
include("../libs/functions.php");

if(!isLoggedInAndAdmin()){
    header("Location: ../index.php");
    exit;
}

$category = new Category();
$categories = $category->getCategory();

$blogs = new Blogs();

if($_SERVER["REQUEST_METHOD"] == "POST"){

        $title = $_POST["title"];
        $content = $_POST["editor"];
        $category_id = $_POST["category_id"];

        if(isset($_FILES["image"]) && !empty($_FILES["image"]["name"])) {
            uploadImage($_FILES["image"]);
            $image = $_FILES["image"]["name"];
        } else {
            $image = $blogEdit->image;
        }

        
        if($blogs->addBlog($title, $content, $image,$category_id)) {
            header("location: blogs.php");
        }
}
?>
<?php
$data = array();

if(isset($_FILES['upload']['name'])){
    $file_name = $_FILES['upload']['name'];
    $file_path = 'images/'.$file_name;
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
?>
<script src="../../editor/build/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-LgV+8OIvaNDJ4qaVRr8p6mBtYXdzXan9/PMz8axkJvVqznY5CxV+q4wYwAIi/kyS" crossorigin="anonymous"></script>

<?php include('../partials/header.php')?>
<?php include('../partials/sidebar.php')?>
<?php include('../partials/main.php')?>


                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Yeni Blog Oluştur</h4>
                                <div class="basic-form">
                                    <form id="blogForm" method="post" enctype="multipart/form-data">
                                    <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Blog Başlığı</label>
                                                <input type="text" class="form-control" name="title" placeholder="Başlık">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Kategori</label>
                                                <select name="category_id" id="category_id" class="form-control">
                                                    <option value="0">Kategori Seçiniz</option>
                                                    <?php foreach($categories as $c): ?>
                                                    <option value="<?php echo $c->id; ?>"><?php echo $c->category_name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                    </div>
                                        <div class="form-group">
                                            <label>İçerik</label>
                                            <textarea type="text" id="editor" name="editor" class="form-control" placeholder="Blog İçeriği"></textarea>
                                        </div>
                                        <div class="input-group mb-5">
                                            <div class="input-group-prepend"><span class="input-group-text">Resim</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input" value="">
                                                <label class="custom-file-label">Resim Seç</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-dark">Paylaş</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


<script src="https://cdn.ckbox.io/CKBox/2.4.0/ckbox.js"></script>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ),{
        
            cloudServices: {
            tokenUrl: 'https://109494.cke-cs.com/token/dev/ABSF900WfyBVvOKm78IMRXK3NEuQrgCmMP5M?limit=10',
            uploadUrl: 'https://109494.cke-cs.com/easyimage/upload/'
		}
        } ).then(data =>{
            console.log(data);
        })
        .catch( error => {
            console.error( error );
        } );
</script>

<?php include('../partials/main-end.php')?>
<?php include('../partials/footer.php')?>