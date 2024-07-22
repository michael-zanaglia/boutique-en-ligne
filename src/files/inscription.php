<?php
    require "classes/database.php";
    require "classes/user.php";
    $user = new User();
    session_start();
    $user -> logoutUser();

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/signIn-Register.css">
    <link rel="stylesheet" href="styles/style.css">
    <title>Inscription</title>
</head>
<body>
    <header class='navigation'>
        <nav class='left-side'> 
            <a href="/boutique-en-ligne/index.php"><img class='logo' src="../asset/logo.png" alt="FOG"></a> 
        </nav>
    </header>
    <main>
        <div class='marge'>
            <h1>INSCRIPTION</h1>
        </div>
        <div class='form-inscription'>
            <form id='inscription'>
                <label for="pseudo">Pseudo*</label>   
                <div class='input-form'>
                    <div class='icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 taille32">
                            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                        </svg>  
                    </div>
                    <input class='inp' type="text" name="pseudo" placeholder="Jeandu13" required> 
                </div>  

                <label for="password">Mot de passe*</label>
                <div class='input-form'>
                    <div class='icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 taille32">
                            <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input class='inp' type="password" name="password" required>  
                </div>

                <label for="mail">Adresse Mail*</label>
                <div class='input-form'>
                    <div class='icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 taille32">
                            <path d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                            <path d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                        </svg>
                    </div>
                    <input class='inp' type="email" name="mail" placeholder="jean.dupont@gmail.com" required>
                </div>  

                <label for="address">Adresse de livraison*</label>
                <div class='input-form'>
                    <div class='icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 taille32">
                            <path d="M19.006 3.705a.75.75 0 1 0-.512-1.41L6 6.838V3a.75.75 0 0 0-.75-.75h-1.5A.75.75 0 0 0 3 3v4.93l-1.006.365a.75.75 0 0 0 .512 1.41l16.5-6Z" />
                            <path fill-rule="evenodd" d="M3.019 11.114 18 5.667v3.421l4.006 1.457a.75.75 0 1 1-.512 1.41l-.494-.18v8.475h.75a.75.75 0 0 1 0 1.5H2.25a.75.75 0 0 1 0-1.5H3v-9.129l.019-.007ZM18 20.25v-9.566l1.5.546v9.02H18Zm-9-6a.75.75 0 0 0-.75.75v4.5c0 .414.336.75.75.75h3a.75.75 0 0 0 .75-.75V15a.75.75 0 0 0-.75-.75H9Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    
                    <input class='inp' type="text" name="address" placeholder="1 rue dupont 13000 Marseille" required>
                </div> 

                <div class='checkbox'>
                    <input type="checkbox" name='check' id="check">
                    <label for="check">Je valide avoir pris connaissance des conditions d'utilisations.</label> 
                </div>

                <button class='btnI' id="rgt" type="submit" disabled>S'inscrire</button>
            </form>
            <a href='connexion.php'>Vous etes deja inscrit ?</a>
        </div>        
    </main>
    <script type='module' src='js/menu.js'></script>
    <script type='module' src='js/register.js'></script>
</body>
</html>