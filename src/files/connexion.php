<?php
    require "classes/user.php";

    session_start();
    $user = new User();

    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $pwd = htmlspecialchars($_POST['password']);
        $res = $user -> checkConnexionUser($pseudo);
        if ($res && ($res['pseudo'] == $pseudo) && (password_verify($pwd, $res['password'])) || $pwd == $res['password']){
            echo json_encode(["success" => true]);
            $_SESSION["user"] = $pseudo;
            //$_SESSION["userClass"] = serialize(new User($_SESSION["user"]));
        } else {
            echo json_encode(["success" => false]);
        }
    }
?>
