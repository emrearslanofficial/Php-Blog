<?php 
include("../../database/db.class.php");
include("../../database/blogs.class.php");

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
            // İşlem başarılı olduğunda, tost mesajı JavaScript kodunda gösterilecek
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
                                <div class="card-header d-flex align-content-center justify-content-between">
                                    <h4 class="card-title">Bloglar</h4>
                                    <a href="add-blog.php"><button class="btn btn-outline-dark">Yeni Blog Ekle</button></a>
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered verticle-middle">
                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Başlık</th>
                                                <th scope="col">İçerik</th>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($blogs->getBlogs() as $blog):?>
                                        <tr>
                                            <td><?php echo $blog->id;?></td>
                                            <td>
                                                <?php
                                                    $title = $blog->title;
                                                    $max_length = 80;
                                                    echo strip_tags(strlen($title) > $max_length ? substr($title, 0, $max_length) . '...' : $title); 
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $content = $blog->content; 
                                                    // Maksimum gösterilecek karakter sayısı
                                                    $max_length = 400;
                                                    // İçeriği kontrol edin ve kısaltın
                                                    echo strip_tags(strlen($content) > $max_length ? substr($content, 0, $max_length) . '...' : $content); 
                                                ?>
                                            </td>
                                            <td>
                                                <img src="../../img/<?php echo $blog->image;?>" style="height:100px;width:125px;" >
                                            </td>
                                            <td>
                                                <a href="/admin/pages/edit-blog.php?id=<?php echo $blog->id; ?>"><i class="fa fa-pencil color-muted m-r-5"></i></a>
                                                <a class="deleteBlog" data-blog-id="<?php echo $blog->id; ?>" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $blog->id; ?>"><i class="fa fa-close color-danger"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="deleteBlogDiv">
    
</div>

                    <script>
    const deleteBlog = document.querySelectorAll(".deleteBlog");
    const deleteBlogDiv = document.getElementById("deleteBlogDiv");

function showDeleteModal(blogId) {
    const modalId = `exampleModal_${blogId}`;
    const modal = document.getElementById(modalId);
    const bsModal = new bootstrap.Modal(modal);
    bsModal.show();
}

deleteBlog.forEach(element => {
    element.addEventListener("click", (event) => {
        event.preventDefault();
        const blogId = element.getAttribute('data-blog-id');
        deleteBlogDiv.innerHTML = `
            <form action="delete_blog.php" id="formAction" method="post">
                <div class="modal" id="exampleModal_${blogId}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Silmek istediğinize emin misiniz?</h5>
                                <button type="button" id="btnClose_${blogId}" class="close" data-bs-dismiss="modal" aria-label="Close">x</button>
                            </div>
                            <div class="modal-body">
                            <input type="hidden" name="id" value="${blogId}">
                                Silmek istediğinize emin misiniz?
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-success">Sil</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>`;
        showDeleteModal(blogId);
    });
});

document.addEventListener("click", event => {
    if (event.target.matches(".btn-close")) {
        const blogId = event.target.id.split("_")[1];
        const modal = document.getElementById(`exampleModal_${blogId}`);
        modal.hidden = true;
        document.body.classList.remove("modal-open"); 
        const modalBackdrop = document.querySelector(".modal-backdrop");
        if (modalBackdrop) modalBackdrop.remove();
    }
});


</script>

<?php include('../partials/main-end.php')?>
<?php include('../partials/footer.php')?>