<?php
    require_once "database.php";

    class Favoris extends Database {
        
        public function __construct(){
            parent::__construct(); 
        }

        public function addToFavoris($id_product, $id_user){
            $req = $this -> _db -> prepare('INSERT INTO favoris (id_product, id_user) VALUES (?,?)');
            $req -> execute([$id_product, $id_user]);
            return true;
        }

        public function deleteArticleFromFavoris($id_product){
            $req = $this -> _db -> prepare('DELETE FROM favoris WHERE id_product = ?');
            $req -> execute([$id_product]);
            return true;
        }

        public function getFavorisArticle($id_product, $id_user){
            $req = $this -> _db -> prepare('SELECT id_product FROM favoris WHERE id_product = ? AND id_user = ?');
            $req -> execute([$id_product, $id_user]);
            return $req -> fetch();
        }

    }
    $exportedFavoris = var_export(new Favoris(), true);
?>