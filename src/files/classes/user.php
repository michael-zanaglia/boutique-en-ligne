<?php
    require_once "database.php";

    class User extends Database {
        
        public function checkConnexionUser($pseudo){
            $req = $this->_db->prepare("SELECT pseudo, password FROM user WHERE pseudo = ?");
            $req -> execute([$pseudo]);
            return $req->fetch(PDO::FETCH_ASSOC);
        }
    }


    $exportedUser = var_export(new User(), true);