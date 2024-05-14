// const loginModal = document.querySelector('#loginModal');
// const loginModalDiv = document.querySelector(".loginModalDiv");


// loginModal.addEventListener("click", ()=>{
//     loginModalDiv.innerHTML = `
//     <form action="/giris.php" id="formAction" method="post">
//         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
//             <div class="modal-dialog">
//                 <div class="modal-content">
//                 <div class="modal-header">
//                     <h1 class="modal-title fs-5" id="exampleModalLabel">Giriş Yap</h1>
//                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
//                 </div>
//                 <div class="modal-body">
//                     <label for="">Kullanıcı Adı: </label>
//                     <input type="text" name="username" class="form-control" required>
//                     <div class="text-danger usernameErr"></div>
//                     <label for="">Şifre: </label>
//                     <input type="password" name="password" class="form-control" required>
//                     <div class="text-danger passwordErr"></div>
//                 </div>
//                 <div class="modal-footer">
//                     <button type="button" id="kayitBtn" class="btn custom-btn">Kayıt Ol</button>
//                     <button type="submit" class="btn btn-outline-success girisBtn">Giriş Yap</button>
//                 </div>
//                 </div>
//             </div>
//         </div>
//     </form>
//     `;


//     const kayitBtn = document.querySelector("#kayitBtn");
    

//     kayitBtn.addEventListener("click", ()=>{
//         console.log("Kayıta basıldı.");
//         const modalContent = document.querySelector(".modal-content");
//         const formAction = document.querySelector("#formAction");
//         formAction.action = "/kayit.php";
//         modalContent.innerHTML = `
//             <div class="modal-header">
//                 <h1 class="modal-title fs-5" id="exampleModalLabel">Giriş Yap</h1>
//                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
//             </div>
//             <div class="modal-body">
//                 <label for="">Kullanıcı Adı: </label>
//                 <input type="text" name="username" class="form-control" required>
//                 <label for="">Ad: </label>
//                 <input type="text" name="name" class="form-control" required>
//                 <label for="">Soyad: </label>
//                 <input type="text" name="surname" class="form-control" required>
//                 <label for="">Şifre: </label>
//                 <input type="password" name="password" class="form-control" required></input>
//                 <label for="">E-posta: </label>
//                 <input type="email" name="email" class="form-control" required>
//             </div>
//             <div class="modal-footer">
//                 <button type="submit" id="kayitOl" class="btn custom-btn">Kayıt Ol</button>
//             </div>
//         `;
//         closeModal();
        
//     });

//     closeModal();

// });

// function closeModal(){
//         document.querySelector('.modal-header .btn-close').addEventListener('click', () => {
//         document.querySelector('#exampleModal').classList.remove('show');
//         document.body.classList.remove('modal-open');
//         document.querySelector('.modal-backdrop').remove(); 
//         });
// }



// const form = document.querySelector('#formAction');

// form.addEventListener('submit', async (event) => {
//     event.preventDefault(); // Formun varsayılan submit işlemini durdur
    
//     const formData = new FormData(form); // Form verilerini FormData nesnesi olarak al
    
//     try {
//         const response = await fetch('/submit', {
//             method: 'POST', // POST isteği gönder
//             body: formData // Form verilerini istek gövdesine ekle
//         });

//         if (response.ok) {
//             // Sunucudan başarılı yanıt geldiyse, kullanıcıyı yönlendir
//             window.location.href = '/'; // Örnek olarak anasayfaya yönlendir
//         } else {
//             // Sunucudan hata yanıtı geldiyse, uygun bir mesaj göster
//             const errorMessage = await response.text();
//             alert(errorMessage); // Örnek olarak bir alert göster
//         }
//     } catch (error) {
//         console.error('Bir hata oluştu:', error);
//     }
// });


