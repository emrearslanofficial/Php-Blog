<?php 
include("../../database/db.class.php");
include("../../database/blogs.class.php");

if(!isLoggedInAndAdmin()){
    header("Location: ../index.php");
    exit;
}

$user = new User();
$users = $user->getUsers();

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
                    <h4 class="card-title">Kullanıcılar</h4>
                </div>             
                <div class="table-responsive">
                    <table class="table table-bordered verticle-middle">
                        <thead>
                            <tr>
                                <th scope="col" class="w-50">Kullanıcı</th>
                                <th scope="col">Rol</th>
                                <th scope="col" class="w-50" >Biyografi</th>
                                <th scope="col" class="w-25" >İşlemler</th>
                            </tr>
                        </thead>
                            <tbody>
                            <?php foreach($users as $us):?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="../<?php echo $us->image;?>" name="image" width="50" height="50" class="mr-3 rounded-circle" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="card-title" name="name" ><?php echo $us->name ." ".$us->surname;?></h6>
                                                        <p class="text-xs text-secondary mb-0" name="mail" ><?php echo $us->mail;?></p>
                                                    </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <p class="text-xs text-secondary text-uppercase font-weight-bold mb-0" name="role"><?php echo $us->role;?></p>
                                                </td>
                                                <td class="align-middle text-left">
                                                    <span class="text-secondary text-xs font-weight-bold" name="biyografi"><?php echo $us->biography;?></span>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="edit-user.php?id=<?php echo $us->id;?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                        Edit
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