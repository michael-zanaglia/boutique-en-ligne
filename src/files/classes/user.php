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

        public function getInformationUser(){
            $req = $this -> _db -> prepare("SELECT * FROM user WHERE pseudo = ?");
            $req -> execute([$this -> getPseudo()]);
            return $req -> fetch(PDO::FETCH_ASSOC);
        }

        public function UpdateUser(int $id, string $pseudo, string $fullName, $birth, string $addr, string $mail) {
            if($birth) {
                $req = $this -> _db -> prepare("UPDATE user SET pseudo = ?, `nom & prenom` = ?, naissance = ?, address = ?, mail = ? WHERE id = ?");
                $req -> execute([$pseudo, $fullName, $birth, $addr, $mail, $id]);
            } else {
                $req = $this -> _db -> prepare("UPDATE user SET pseudo = ?, `nom & prenom` = ?, address = ?, mail = ? WHERE id = ?");
                $req -> execute([$pseudo, $fullName, $addr, $mail, $id]);
            }
            if($req){
                return true;
            } else {
                return false;
            } 
        }

        public function logoutUser(){
            if(isset($_POST['deco'])){
                session_destroy();
                header("Location: connexion.html");
            }
        }
    }


    $exportedUser = var_export(new User(), true);