<?php
    require_once "database.php";
    require_once "image.php";

    class Product extends Database {

        public $_imageClass;

        public function __construct(){
            parent::__construct(); // Call the parent constructor to initialize the database connection
            $this -> _imageClass = new Image();
        }

        public function getMyTop() {
            $req = $this -> _db -> query("SELECT * FROM product WHERE state IS NOT NULL AND state <> '' ORDER BY state ASC");
            $result = $req -> fetchAll();
            return $result;
        }

        public function getHighestPrice(){
            $req = $this -> _db -> query("SELECT price FROM product ORDER BY price DESC LIMIT 1");
            $result = $req -> fetch();
            return $result;
        }

        public function getNameByCompletion($mot){
            $mot = '%'.$mot.'%';
            $req = $this -> _db -> prepare("SELECT name, id FROM product WHERE name LIKE ?");
            $req -> execute([$mot]);
            $result = $req -> fetchAll();
            return $result;
        }

        public function getNewItems(){
            $req = $this -> _db -> query("SELECT image, id FROM product ORDER BY id DESC LIMIT 3");
            $result = $req -> fetchAll();
            return $result;
        }

        public function getAllItems(){
            $req = $this -> _db -> query("SELECT * FROM product");
            $result = $req -> fetchAll();
            return $result;
        }

        public function getAllProduct(){
            $req = $this -> _db -> query("SELECT product.*, category.category_name FROM product INNER JOIN category ON product.id_category = category.id") ;
            $results = $req->fetchAll();
            return $results;   
        }

        public function getInfoById($id){
            $req = $this -> _db -> prepare("SELECT * FROM product WHERE id = ?");
            $req -> execute([$id]) ;
            return $req -> fetch();   
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

        public function getStock($id){
            $req = $this -> _db -> prepare("SELECT stock FROM product WHERE id = ?");
            $req -> execute([$id]);
            $result = $req -> fetch();
            return $result['stock'];
        }

        public function updateProduct($form, $img){
            $id = htmlspecialchars($form['upt']);
            $name = htmlspecialchars($form['name']);
            $description = htmlspecialchars($form['description']);
            $stock = htmlspecialchars($form['stock']);
            $price = htmlspecialchars($form['price']);
            $state = htmlspecialchars($form['state']);
            $image = $img;
            $category = htmlspecialchars($form['category']);
            $id_category = $this -> getCategoryId($category);

            if($_FILES['image']['name'] !== ''){
                $imgBase64 = $this -> _imageClass -> imageToBase64($image);
                $req = $this -> _db -> prepare("UPDATE product SET name = ?, description = ?, stock = ?, price = ?, state = ?, image = ?, id_category = ? WHERE id = ?");
                $req -> execute([$name, $description, $stock, $price, $state, $imgBase64, $id_category, $id]);
            } else {
                $req = $this -> _db -> prepare("UPDATE product SET name = ?, description = ?, stock = ?, price = ?, state = ?, id_category = ? WHERE id = ?");
                $req -> execute([$name, $description, $stock, $price, $state, $id_category, $id]);
            }
            //echo $name, $description, $stock, $price, $state, $imgBase64, $id_category, $id;
            header('Location: admin.php'); // Redirige vers une page de confirmation
            exit;
        }

        public function deleteProduct($form){
            $id = $form['del'];
            $req = $this -> _db -> prepare("DELETE FROM product WHERE id = ?");
            $req -> execute([$id]);
            header('Location: admin.php'); // Redirige vers une page de confirmation
            exit;
        }

        public function UpdateStock($stayed, $id){
            $req = $this -> _db -> prepare("UPDATE product SET stock = ? WHERE id = ?");
            $req -> execute([($stayed), $id]);
        }

        public function addProduct($form, $img){
            $name = htmlspecialchars($form['add-name']);
            $description = htmlspecialchars($form['add-desc']);
            $stock = htmlspecialchars($form['add-stock']);
            $price = htmlspecialchars($form['add-price']);
            $state = htmlspecialchars($form['add-state']);
            $image = $img;
            $category = htmlspecialchars($form['add-category']);
            $id_category = $this -> getCategoryId($category);

            $imgBase64 = $this -> _imageClass -> imageToBase64($image);
            
            $req = $this -> _db -> prepare("INSERT INTO product (name, description, stock, price, state, image, id_category) VALUES (?,?,?,?,?,?,?)");
            $req -> execute([$name, $description, $stock, $price, $state, $imgBase64, $id_category]);
            header('Location: admin.php'); // Redirige vers une page de confirmation
            exit;
        }
    }
    $exportedProduct = var_export(new Product(), true);
?>
