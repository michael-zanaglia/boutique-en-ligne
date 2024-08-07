<?php
    require "classes/user.php";
    //header("Content-type: application/json");
    session_start();
    $user = new User();
    $user -> logoutUser();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/signIn-Register.css">
    <title>Connexion</title>
</head>
<body>
    <header class='navigation'>
        <nav class='left-side'>
            <a href="/boutique-en-ligne/index.php"><img class='logo' src="../asset/logo.png" alt="FOG"></a>   
        </nav>
    </header>
    <main>
        <div class='marge'>
            <h1>CONNEXION</h1>
        </div>
        <div class='form-connexion'>
            <form id='connexion'>
                <label for="pseudo">Pseudo*</label>   
                <div class='input-form'>
                    <div class='icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 taille32">
                            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                        </svg>  
                    </div>
                    <input class='inp' type="text" name="pseudo"> 
                </div>  

                <label for="password">Mot de passe*</label>
                <div class='input-form'>
                    <div class='icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 taille32">
                            <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input class='inp-co' type="password" name="password">  
                    <div class="icon-eye">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 taille32">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </div>
                </div>

                <button class='btn-vert' type="submit">Se Connecter</button>
            </form>
            <a href='inscription.php'>Vous n'etes pas incrit ?</a>
        </div>        
    </main>
    <script type='module' src='js/menu.js'></script>
    <script type="module" src="js/signin.js"></script>
</body>
</html>