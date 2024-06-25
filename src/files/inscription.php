<?php
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $pwd = htmlspecialchars($_POST['password']);
        $mail = htmlspecialchars($_POST['mail']);
        $addr = htmlspecialchars($_POST['address']);
        $data = array(
            "pseudo" => $pseudo,
            "pwd" => $pwd,
            "mail" => $mail,
            "addr" => $addr
        );
        echo json_encode($data);
    };
