<?php
    require_once "database.php";

    class User extends Database {

        private $_pseudo;

        public function __construct(string $pseudo="GEST"){
            parent::__construct(); // Call the parent constructor to initialize the database connection
            $this -> _pseudo = $pseudo;
        }

        public function getPseudo(){
            return $this ->_pseudo;
        }
        
        public function checkConnexionUser(string $pseudo){
            $req = $this->_db->prepare("SELECT pseudo, password FROM user WHERE pseudo = ?");
            $req -> execute([$pseudo]);
            return $req->fetch(PDO::FETCH_ASSOC);
        }
    }


    $exportedUser = var_export(new User(), true);