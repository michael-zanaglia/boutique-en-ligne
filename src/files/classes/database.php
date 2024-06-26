<?php 
    class DataBase{
        private $_HOST = "localhost:3307";
        private $_passwordDb = "";
        private $_userDb = "root";
        private $_NAME = "boutique"; 
        protected $_db;

        public function __construct(){
            try {
                $this->_db = new PDO("mysql:host=$this->_HOST;dbname=$this->_NAME;character utf8",$this->_userDb, $this->_passwordDb);
                $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            } catch(PDOException $e){
                echo "Erreur :". $e->getMessage();
            }    
        }

        private function userExist($pseudo, $mail){
            $req = $this->_db->prepare("SELECT pseudo, mail FROM user WHERE pseudo = ? OR mail = ?");
            $req -> execute([$pseudo, $mail]);
            return $req -> fetchAll(PDO::FETCH_ASSOC);
        }

        public function insertNewUser($pseudo, $pwd, $mail, $addr) {
            $exist = $this -> userExist($pseudo, $mail);
            if (count($exist) < 1){
                $req = $this->_db -> prepare("INSERT INTO user (pseudo, address, password, mail) VALUES (?,?,?,?)");
                $req -> execute([$pseudo, $addr, $pwd, $mail]);  
                return "";
            } else {
                return "L'utilisateur existe déja !";
            }
            
        }
    }
    $exportedDataBase = var_export(new DataBase(), true);