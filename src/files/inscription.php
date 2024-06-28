<?php
    require "classes/database.php";

    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $pwd = htmlspecialchars($_POST['password']);
        $mail = htmlspecialchars($_POST['mail']);
        $addr = htmlspecialchars($_POST['address']);
        $msg = "Une Erreur est survenue (inscription.php).";
        $success = 0;

        if (strlen($pseudo) <= 10){
            $database = new DataBase();
            $validPwd = $database -> checkPassword($pwd);
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
