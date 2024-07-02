<?php
    require_once "database.php";

    class Product extends Database {

        public function __construct(){
            parent::__construct(); // Call the parent constructor to initialize the database connection
        }

        public function getAllProduct(){
            $req = $this -> _db -> query("SELECT product.*, category.category_name FROM product INNER JOIN category ON product.id_category = category.id") ;
            $results = $req->fetchAll();
            return $results;   
        }

        public function getAllCategory(){
            $req = $this -> _db -> query("SELECT category_name FROM category");
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getCategoryId($cat){
            $req = $this -> _db -> prepare("SELECT id FROM category WHERE category_name = ?");
            $req -> execute([$cat]);
            $result = $req -> fetch(PDO::FETCH_ASSOC);
            return $result['id'];
        }

        public function updateProduct($form){
            $id = htmlspecialchars($form['upt']);
            $name = htmlspecialchars($form['name']);
            $description = htmlspecialchars($form['description']);
            $stock = htmlspecialchars($form['stock']);
            $price = htmlspecialchars($form['price']);
            $state = htmlspecialchars($form['state']);
            $image = htmlspecialchars($form['image']);
            $category = htmlspecialchars($form['category']);
            $id_category = $this -> getCategoryId($category);
            var_dump($id_category);
            $req = $this -> _db -> prepare("UPDATE product SET name = ?, description = ?, stock = ?, price = ?, state = ?, image = ?, id_category = ? WHERE id = ?");
            $req -> execute([$name, $description, $stock, $price, $state, $image, $id_category, $id]);
            echo $name, $description, $stock, $price, $state, $image, $id_category, $id;
            header('Location: admin.php'); // Redirige vers une page de confirmation
            exit;
        }

        public function deleteProduct($form){
            $id = $form['del'];
            $req = $this -> _db -> prepare("DELETE product WHERE id = ?");
            $req -> execute([$id]);
            header('Location: admin.php'); // Redirige vers une page de confirmation
            exit;
        }

        public function addProduct($form){
            $name = htmlspecialchars($form['add-name']);
            $description = htmlspecialchars($form['add-desc']);
            $stock = htmlspecialchars($form['add-stock']);
            $price = htmlspecialchars($form['add-price']);
            $state = htmlspecialchars($form['add-state']);
            $image = htmlspecialchars($form['add-img']);
            $category = htmlspecialchars($form['add-category']);
            $id_category = $this -> getCategoryId($category);
            $req = $this -> _db -> prepare("INSERT INTO product (name, description, stock, price, state, image, id_category) VALUES (?,?,?,?,?,?,?)");
            $req -> execute([$name, $description, $stock, $price, $state, $image, $id_category]);
            header('Location: admin.php'); // Redirige vers une page de confirmation
            exit;
        }
    }
    $exportedProduct = var_export(new Product(), true);
?>
