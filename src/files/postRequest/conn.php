<?php
    require "../classes/user.php";
    session_start();
    $user = new User();
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        $pseudo = $_POST['pseudo'];
        $pwd = $_POST['password'];
        $res = $user -> checkConnexionUser($pseudo);
        if ($res && ($res['pseudo'] == $pseudo) && (password_verify($pwd, $res['password'])) || $pwd == $res['password']){
            $send = ["success" => true];
            $_SESSION["user"] = $pseudo;
            //$_SESSION["userClass"] = serialize(new User($_SESSION["user"]));
        } else {
            $send = ["success" => false];
        }
        echo json_encode($send);
    }