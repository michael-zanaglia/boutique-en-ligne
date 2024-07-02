<?php
    require_once "database.php";

    class Product extends Database {

        public function __construct(){
            parent::__construct(); // Call the parent constructor to initialize the database connection
        }

        public function getAllProduct(){
            $req = $this -> _db -> query("SELECT * FROM product INNER JOIN category ON product.id_category = category.id") ;
            $results = $req->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($results);
            return $results;   
        }

        public function getAllCategory(){
            $req = $this -> _db -> query("SELECT category_name FROM category");
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    $exportedProduct = var_export(new Product(), true);
?>
