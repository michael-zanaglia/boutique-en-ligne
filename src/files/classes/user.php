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

        public function getId(){
            $req = $this->_db->prepare("SELECT id FROM user WHERE pseudo = ?");
            $req -> execute([$this -> getPseudo()]);
            return $req->fetch();
        }

        public function getPassword(){
            $req = $this->_db->prepare("SELECT password FROM user WHERE pseudo = ?");
            $req -> execute([$this -> getPseudo()]);
            return $req->fetch(PDO::FETCH_ASSOC);
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
                header("Location: connexion.php");
            }
        }

        public function checkMyPassword($prevPwd){
            $currentPwd = $this -> getPassword();
            if(password_verify($prevPwd, $currentPwd['password'])){
                return true;
            } else {
                return false;
            }
        }

        public function changePassword($newPwd){
            $success = $this -> checkPassword($newPwd);
            if($success){
                $req = $this -> _db -> prepare("UPDATE user SET password = ? WHERE pseudo = ?");
                $req -> execute([password_hash($newPwd, PASSWORD_DEFAULT), $this -> getPseudo()]);
                if ($req){
                return "Mot de passe mis à jour :) !";
                } else {
                    return "Erreur (user.php) ---> changePassword()";
                }   
            } else {
                return 'Votre mot de passe doit avoir au moins 8 caractères dont minimum une lettre minuscule et majuscule, un chiffre et un caractère spécial';
            }
              
        }
    }


    $exportedUser = var_export(new User(), true);