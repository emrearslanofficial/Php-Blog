<?php
    class Db{
        private $host = "localhost";
        private  $username = "root";
        private  $pass = "";
        private  $db = "blogs";

        protected function connect(){
            try{
                $dsn = "mysql:host=".$this->host.";dbname=".$this->db;
                $conn = new PDO($dsn,$this->username,$this->pass);

                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
                return $conn;
                
            }
            catch(PDOException $e){
                echo "Bağlantı hatası! ".$e->getMessage();
            }
        }
    }
?>