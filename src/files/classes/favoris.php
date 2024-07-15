<?php
    require_once "database.php";
    require_once "product.php";

    class Favoris extends Database {
        
        public $_product;

        public function __construct(){
            parent::__construct(); 
            $this -> _product = new Product();
        }

        public function addToFavoris($id_product, $id_user){
            $req = $this -> _db -> prepare('INSERT INTO favoris (id_product, id_user) VALUES (?,?)');
            $req -> execute([$id_product, $id_user]);
            return true;
        }

        public function deleteArticleFromFavoris($id_product, $id_user){
            $req = $this -> _db -> prepare('DELETE FROM favoris WHERE id_product = ? AND id_user = ?');
            $req -> execute([$id_product, $id_user]);
            return true;
        }

        public function getFavorisArticle($id_product, $id_user){
            $req = $this -> _db -> prepare('SELECT id_product FROM favoris WHERE id_product = ? AND id_user = ?');
            $req -> execute([$id_product, $id_user]);
            return $req -> fetch();
        }

        public function getAllFav($id_user){
            $req = $this -> _db -> prepare('SELECT product.id, product.name, product.price, product.image FROM favoris INNER JOIN product on product.id = favoris.id_product AND id_user = ?');
            $req -> execute([$id_user]);
            return $req -> fetchAll();
        }

    }
    $exportedFavoris = var_export(new Favoris(), true);
?>