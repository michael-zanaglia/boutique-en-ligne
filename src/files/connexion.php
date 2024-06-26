<?php
    require "classes/user.php";
    
    $user = new User();

    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $pwd = htmlspecialchars($_POST['password']);
        $res = $user -> checkConnexionUser($pseudo);
        if ($res && ($res['pseudo'] == $pseudo) && (password_verify($pwd, $res['password'])) || $pwd == $res['password']){
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false]);
        }
    }
?>
