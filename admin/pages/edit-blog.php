<?php 
include("../../database/db.class.php");
include("../../database/blogs.class.php");

if(!isLoggedInAndAdmin()){
    header("Location: ../index.php");
    exit;
}

$category = new Category();
$categories = $category->getCategory();

// URL'den id parametresini alın
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id !== null && is_numeric($id)) {
    $blogs = new Blogs();
    $blogEdit = $blogs->getBlogsById($id);
} else {
    echo "Geçersiz blog ID.";
}

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $title = $_POST["title"];
        $content = $_POST["editor"];
        
        if(isset($_FILES["image"]) && !empty($_FILES["image"]["name"])) {
            uploadImage($_FILES["image"]);
            $image = $_FILES["image"]["name"];
        } else {
            $image = $blogEdit->image;
        }

        if(isset($_POST["category_id"]) && !empty($_POST["category_id"])){
            $category_id = $_POST["category_id"];
        }else{
            $category_id = $blogEdit->category_id;
        }
        
        if($blogs->editBlog($id, $title, $content, $image,$category_id)) {
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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Blogu Düzenle</h6>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data"> 
                                <div class="row">
                                    <div class="col-10">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Başlık</label>
                                                <input type="text" name="title" class="form-control w-75" value="<?php echo $blogEdit->title;?>">
                                            </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Kategori</label>
                                                    <select name="category_id" id="category_id" class="form-control">
                                                        <option value="0">Kategori Seçiniz</option>
                                                        <?php foreach($categories as $c): ?>
                                                            <option value="<?php echo $c->id; ?>"><?php echo $c->category_name; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="mb-3">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">İçerik</label>
                                            <textarea id="editor" name="editor" class="form-control w-100"><?php echo $blogEdit->content;?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Resim</label>
                                            <input type="file" name="image" class="form-control w-75" value="<?php echo $blogEdit->image;?>">
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-outline-success">Kaydet</button>
                                        </div>
                                    </div>
                                </div>
                            </form>                          
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