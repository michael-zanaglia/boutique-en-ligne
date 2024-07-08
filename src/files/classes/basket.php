<?php
    require_once "database.php";
    require_once "product.php";
    //require_once "user.php";

    class Basket extends Database {
        //public $_user; 
        public $_product;

        public function __construct(){
            parent::__construct(); // Call the parent constructor to initialize the database connection
            //$this -> _user = new User();
            $this -> _product = new Product();
        }

        public function checkDatabase($id_user, $id_product){
            $req = $this->_db->prepare("SELECT id_user, id_product FROM basket WHERE id_user = ? AND id_product = ?");
            $req->execute([$id_user, $id_product]);
            $result = $req->fetch();
            return $result ? true : false;
        }

        public function getQuantite($id){
            $req = $this -> _db -> prepare("SELECT quantite FROM basket WHERE id_product = ?");
            $req -> execute([$id]);
            return $req -> fetch();
        }

        public function updateDataBasket($quantite, $id_user, $id_product) {
            $getQuant = $this -> getQuantite($id_product);
            var_dump($getQuant);
            $newQuant = $quantite + $getQuant['quantite'];
            $req = $this -> _db -> prepare("UPDATE basket SET quantite = ? WHERE id_user = ? AND id_product = ?");
            $result = $req -> execute([$newQuant, $id_user, $id_product]);
            return $result ? true : false;
        }

        public function addToBasketDatabase(int $id_user, int $quantite, int $id_product){
            $exist =  $this -> checkDatabase($id_user, $id_product);
            if($exist){
                $result = $this -> updateDataBasket($quantite, $id_user, $id_product);
            } else {
                $req = $this -> _db -> prepare("INSERT INTO basket (quantite, id_user, id_product) VALUES (?,?,?)");
                $result = $req -> execute([$quantite, $id_user, $id_product]); 
            }
            
            return $result ? true : false;
        }
    }

    $exportedBasket = var_export(new Basket(), true);
?>