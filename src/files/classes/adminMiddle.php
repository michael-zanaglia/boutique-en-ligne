<?php
    require_once "database.php";
    require_once "image.php";

    class Admin extends Database {

        public $_imageClass;
        
        public function __construct(){
            parent::__construct(); // Call the parent constructor to initialize the database connection
            $this -> _imageClass = new Image();
        }

        public function getAllNextProduct(){
            try {
                // Utilisation de requête préparée pour éviter les injections SQL
                $req = $this->_db->query("SELECT * FROM middle");
                $result = $req->fetchAll(PDO::FETCH_ASSOC); // Récupération des résultats sous forme de tableau associatif
                return $result;
            } catch(PDOException $e) {
                // Gestion des erreurs de requête SQL
                //echo "Erreur SQL : " . $e->getMessage();
                return false; // Ou autre gestion d'erreur appropriée selon votre application
            }
        }

        public function getNextImgs(){
            $req = $this -> _db -> query("SELECT image FROM middle");
            $result = $req -> fetchAll();
            return $result;
        }

        public function addNextProduct($form, $img){
            try {
                $name = htmlspecialchars($form['add-name']);
                $description = htmlspecialchars($form['add-desc']);
                $image = $img;
                var_dump($image);
                $imgBase64 = $this -> _imageClass -> imageToBase64($image);
                $req = $this -> _db -> prepare("INSERT INTO middle (name, description, image) VALUES (?,?,?)");
                $req -> execute([$name, $description, $imgBase64]);
                header('Location: admin.php'); // Redirige vers une page de confirmation
                exit;
            } catch(PDOException $e) {
                echo "Erreur SQL : " . $e->getMessage();
            }
        }

        public function updateNewProduct($form, $img){
            var_dump($form);
            try {
                $id = htmlspecialchars($form['admin-upt']);
                $name = htmlspecialchars($form['name']);
                $description = htmlspecialchars($form['description']);
                $image = $img;
                if($_FILES['image']['name'] !== ''){
                    $imgBase64 = $this -> _imageClass -> imageToBase64($image);
                    $req = $this -> _db -> prepare("UPDATE middle SET name = ?, description = ?, image = ? WHERE id = ?");
                    $req -> execute([$name, $description, $imgBase64, $id]);
                } else {
                    $req = $this -> _db -> prepare("UPDATE middle SET name = ?, description = ? WHERE id = ?");
                    $req -> execute([$name, $description, $id]);
                }
                //echo $name, $description, $stock, $price, $state, $imgBase64, $id_category, $id;
                header('Location: admin.php'); // Redirige vers une page de confirmation
                exit;  
            } catch(PDOException $e){
                echo "Erreur SQL : " . $e->getMessage();
            }
            
        }

        public function deleteNewProduct($form){
            $id = $form['admin-del'];
            $req = $this -> _db -> prepare("DELETE FROM middle WHERE id = ?");
            $req -> execute([$id]);
            header('Location: admin.php'); // Redirige vers une page de confirmation
            exit;
        }
    }

    $exportedAdmin = var_export(new Admin(), true);