<?php
    require "classes/database.php";

    function checkPassword($password){
        if (strlen($password) < 8){
            return false;
        }
        if (!preg_match('/[a-z]/', $password)){
            return false;
        }
        if (!preg_match('/[A-Z]/', $password)){
            return false;
        }
        if (!preg_match('/[0-9]/', $password)){
            return false;
        }
        if (!preg_match('/[^a-zA-Z0-9]/', $password)){
            return false;
        }
        return true;
    } 

    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $pwd = htmlspecialchars($_POST['password']);
        $mail = htmlspecialchars($_POST['mail']);
        $addr = htmlspecialchars($_POST['address']);
        $msg = "Une Erreur est survenue (inscription.php).";
        $success = 0;

        if (strlen($pseudo) <= 10){
            $validPwd = checkPassword($pwd);
            if ($validPwd){
                $pwd = htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT));
                $success = 1;
                $msg = "";
            } else {
                $msg = 'Votre mot de passe doit avoir au moins 8 caractères dont minimum une lettre minuscule et majuscule, un chiffre et un caractère spécial';
            }
        } else {
            $msg = 'Le pseudo est trop long.';
        }
        if ($success == 1){
            $database = new DataBase();
            $res = $database -> insertNewUser($pseudo, $pwd, $mail, $addr);
            $msg = $res;
        }

        $data = array(
            "success" => $success,
            "msg" => $msg,
            "pseudo" => $pseudo,
            "pwd" => $pwd,
            "mail" => $mail,
            "addr" => $addr
        );

        echo json_encode($data);
    };
