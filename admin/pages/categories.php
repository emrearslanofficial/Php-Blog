<?php 
include("../../database/db.class.php");
include("../../database/blogs.class.php");

if(!isLoggedInAndAdmin()){
    header("Location: ../index.php");
    exit;
}

$category = new Category();
$categories = $category->getCategory();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $_POST["category_name"];
    
    if (isset($_POST['category_id']) && !empty($_POST['category_id'])) {
        $category_id = $_POST["category_id"];
        $category->editCategory($category_id, $category_name);
    } else {
        $categoryAdd = $category->createCategory($category_name);
    }
}   
?>

<script src="../../editor/build/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-LgV+8OIvaNDJ4qaVRr8p6mBtYXdzXan9/PMz8axkJvVqznY5CxV+q4wYwAIi/kyS" crossorigin="anonymous"></script>

<?php include('../partials/header.php')?>
<?php include('../partials/sidebar.php')?>
<?php include('../partials/main.php')?>



<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-body">
                <div class="card-header d-flex align-content-center justify-content-between">
                    <h4 class="card-title">Kategoriler</h4>
                </div>
                                    
                <div class="table-responsive">
                    <table class="table table-bordered verticle-middle">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col" class="w-50">Kategori Adı</th>
                                <th scope="col" class="w-25" >Düzenle</th>
                            </tr>
                        </thead>
                            <tbody>
                                <?php foreach($categories as $cat):?>
                                    <tr>
                                        <td><?php echo $cat->id;?></td>
                                        <td><?php echo $cat->category_name;?></td>
                                        <td class="text-center">
                                            <a href="#" onclick="editCategory('<?php echo $cat->category_name;?>', '<?php echo $cat->id;?>')">
                                                <i class="fa fa-pencil color-muted m-r-5"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach?>            
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <form method="post" id="categoryForm">
                    <input type="hidden" name="category_id" id="category_id" value="">
                    <input type="hidden" name="action" id="action" value="add">
                    <div class="mb-3">
                        <label for="">Kategori Adı</label>
                        <input type="text" name="category_name" class="form-control w-100">
                    </div>
                    <button type="submit" class="btn btn-outline-success w-100">Ekle / Güncelle</button>
                </form>
            </div>
        </div>            
    </div>
</div>

<script>
    // Düzenleme simgesine tıklandığında
    function editCategory(categoryName, categoryId) {
        // Kategori adını ve ID'sini form alanlarına yerleştir
        document.querySelector('input[name="category_name"]').value = categoryName;
        document.querySelector('#action').value = "edit";
        // Düzenlenen kategorinin ID'sini gizli bir alana ekleyin
        document.querySelector('#category_id').value = categoryId;  
    }

    // Form submit edildiğinde
    document.getElementById('categoryForm').addEventListener('submit', function(event) {
        // Formun normal submit işlemini engelle
        event.preventDefault();

        // Form verilerini alın
        var formData = new FormData(this);

        // Hangi işlemi gerçekleştireceğimizi kontrol edin (ekleme veya düzenleme)
        var action = document.querySelector('#action').value;

        // İlgili PHP dosyasına AJAX isteği gönderin
        fetch('category.php?action=' + action, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            // Yanıtı kontrol et ve gerektiğinde işlem yap
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text(); // Yanıtı metin olarak al
        })
        .then(data => {
            // Yanıtı işle
            console.log(data); // İşlem sonucunu konsola yazdır
            // İşlem başarılı olduğunda sayfayı yenileyebilir veya başka bir işlem yapabilirsiniz
            window.location.reload();
        })
        .catch(error => {
            // Hata durumunda işlem yap
            console.error('There was a problem with your fetch operation:', error);
        });
    });
</script>


<?php include('../partials/main-end.php')?>
<?php include('../partials/footer.php')?>