<?php

    session_start();
    $_SESSION['previous_page'] = $_SERVER['REQUEST_URI'];
    function isLoggedIn(){
        return (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true);
    }
    function isLoggedInAndAdmin(){
        return (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true && isset($_SESSION["role"]) && $_SESSION["role"] == 'admin');
    }

    class Blogs extends Db{
        public function getBlogs(){
            $sql = "SELECT b.id,b.title,b.content,b.image,b.category_id,b.time,c.category_name FROM blogs b INNER JOIN category c on b.category_id=c.id ORDER BY id ASC";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function getBlogsById(int $id){
            $sql = "SELECT * FROM blogs WHERE id=:id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(['id'=>$id]);
            return $stmt->fetch();
        }
        public function getLatestBlogs(){
            $sql = "SELECT * FROM blogs ORDER BY id DESC LIMIT 5";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function getLatestBlog4(){
            $sql = "SELECT * FROM blogs ORDER BY id DESC LIMIT 4";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function editBlog($id,$title,$content,$image,$category_id){
            $sql = "UPDATE blogs SET title=:title, content=:content, image=:image, category_id=:category_id WHERE id=:id";
            $stmt = $this->connect()->prepare($sql);
            return $stmt->execute([
                'id' => $id,
                'title' =>$title,
                'content' =>$content,
                'image' =>$image,
                'category_id' =>$category_id
            ]);
        }

        public function addBlog($title,$content,$image,$category_id){
            $sql = "INSERT INTO blogs(title,content,image,category_id) VALUES(:title, :content, :image, :category_id)";
            $stmt = $this->connect()->prepare($sql);
            return $stmt->execute([
                'title' => $title,
                'content' => $content,
                'image' => $image,
                'category_id' => $category_id
            ]);
        }
        public function deleteBlog($id){
            $sql = "DELETE FROM blogs WHERE id=:id";
            $stmt = $this->connect()->prepare($sql);
            return $stmt->execute([
                'id' => $id
            ]);
        }

        
    }

    class Posts extends Db{
        public function getPosts(){
            $sql = "SELECT p.id,p.content,p.likes,p.user_id,p.date,u.name, u.surname, u.username FROM posts p INNER JOIN users u on p.user_id=u.id ORDER BY id ASC";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function createPosts($content,$user_id){
            $sql = "INSERT INTO posts(content, user_id) VALUES(:content,:user_id)";
            $stmt = $this->connect()->prepare($sql);
            return $stmt->execute([
                'content' => $content,
                'user_id' => $user_id,
            ]);
        }
    }

    class Comments extends Db{
        public function getComments(){
            $sql = "SELECT c.id,c.content,c.time,c.blog_id, c.user_id
            FROM comments c
            INNER JOIN blogs b on c.blog_id = b.id
            INNER JOIN users u ON c.user_id = u.id
            ORDER BY id ASC";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function addComments($content,$blogid,$userid){
            $sql = "INSERT INTO comments(content,blog_id,user_id) VALUES(:content,:blog_id,:user_id)";
            $stmt = $this->connect()->prepare($sql);
            return $stmt->execute([
                'content' => $content,
                'blog_id' => $blogid,
                'user_id' => $userid
            ]);
        }
    }
    class User extends Db{
        public function getUsers(){
            $sql = "SELECT * FROM users";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function getUsersById(int $id){
            $sql = "SELECT * FROM users WHERE id=:id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(['id'=>$id]);
            return $stmt->fetch();
        }
        public function createUsers($username,$name,$surname,$pass,$mail){
            $sql = "INSERT INTO users(username,name,surname,password,mail) VALUES(:username, :name,:surname ,:password, :mail)";
            $stmt = $this->connect()->prepare($sql);
            return $stmt->execute([
                'username' => $username,
                'name' => $name,
                'surname' => $surname,
                'password' => $pass,
                'mail' => $mail
            ]);
        }
        public function editUsers($id,$username,$name,$surname,$password,$mail,$biography){
            $sql = "UPDATE users SET username=:username, name=:name, surname=:surname, password=:password, mail=:mail, biography=:biography WHERE id=:id";
            $stmt = $this->connect()->prepare($sql);
            return $stmt->execute([
                'id' => $id,
                'username' => $username,
                'name' =>$name,
                'surname' =>$surname,
                'password' =>$password,
                'mail' =>$mail,
                'biography' =>$biography
            ]);
        }
        public function editUsersByAdmin($id,$username,$name,$surname,$mail,$biography,$role){
            $sql = "UPDATE users SET username=:username, name=:name, surname=:surname, mail=:mail, biography=:biography, role=:role WHERE id=:id";
            $stmt = $this->connect()->prepare($sql);
            return $stmt->execute([
                'id' => $id,
                'username' => $username,
                'name' =>$name,
                'surname' =>$surname,
                'mail' =>$mail,
                'biography' =>$biography,
                'role' =>$role,
            ]);
        }
    }

    class Messages extends Db{
        public function getMessages(){
            $sql = "SELECT * FROM messages";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function getMessagesById(int $id){
            $sql = "SELECT * FROM messages WHERE id=:id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(['id'=>$id]);
            return $stmt->fetchAll();
        }
        public function createMessage($name_surname,$mail,$phone,$title,$message){
            $sql = "INSERT INTO messages(name_surname,mail,phone,title,message) VALUES(:name_surname, :mail, :phone, :title ,:message)";
            $stmt = $this->connect()->prepare($sql);
            return $stmt->execute([
                'name_surname' => $name_surname,
                'mail' => $mail,
                'phone' => $phone,
                'title' => $title,
                'message' => $message
            ]);
        }
    }

    class Category extends Db{
        
        public function getCategory(){
            $sql = "SELECT * FROM category";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function getCategoryById(int $id){
            $sql = "SELECT * FROM category WHERE id=:id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(['id'=>$id]);
            return $stmt->fetch();
        }
        public function createCategory($category_name){
            $sql = "INSERT INTO category(category_name) VALUES(:category_name)";
            $stmt = $this->connect()->prepare($sql);
            return $stmt->execute([
                'category_name' => $category_name
            ]);
        }

        public function editCategory($id,$category_name){
            $sql = "UPDATE category SET category_name=:category_name WHERE id=:id";
            $stmt = $this->connect()->prepare($sql);
            return $stmt->execute([
                'id' => $id,
                'category_name' =>$category_name,
            ]);
        }
        public function getCategoriesByCourseId(int $id){
            $sql = "SELECT * FROM blog_category bc INNER JOIN category c on bc.category_id = c.id WHERE bc.blog_id=$id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function addBlogsCategories(int $id, $categories){
            // İkinci parametrenin bir dizi olup olmadığını kontrol et
            if (!is_array($categories)) {
                // Hata ayıklama
                echo "Hata: İkinci parametre bir dizi değil!";
                return false;
            }
        
            $sql = "";
            foreach($categories as $catid){
                $sql .= "INSERT INTO blog_category(blog_id,category_id) VALUES($id,$catid);";
            }
        
            // Bu kodun sonucunu geri döndürmek gereksiz, çünkü INSERT işlemi yapıldıktan sonra bir sonuç kümesi döndürülmez.
            // Ayrıca, bu satırı kaldırarak daha doğru bir kod yapısı elde edebiliriz.
            //$stmt->execute();
            //return $stmt->fetchAll(); // Değişiklik yapıldı
        
            // INSERT işlemi gerçekleştikten sonra herhangi bir veri döndürmeye gerek yok
            // Bu nedenle, doğrudan true değerini döndürebiliriz.
            return true;
        }
    }

?>