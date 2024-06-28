<?php
    require "classes/user.php";
    session_start();
    $user = new User();
    if (isset($_SESSION['user'])){
        $user = new User($_SESSION['user']);
    } else {
        $user = new User();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/home.css">
    <title>Acceuil</title>
</head>
<body>
    <header class='navigation'>
        <nav class='right-side'>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"stroke-width="1.5" stroke="currentColor" class="size-6 taille64">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
            </svg>
            <a href="acceuil.php"><img class='logo' src="../asset/logo.png" alt="FOG"></a>
        </nav>
        <nav>
            <ul>
                <li>
                    <a href="profile.php">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#000000" class="size-6 taille32">
                            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                        </svg> 
                    </a>
                    
                </li>
                <li>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#000000" class="size-6 taille32">
                            <path fill-rule="evenodd" d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 0 0 4.25 22.5h15.5a1.875 1.875 0 0 0 1.865-2.071l-1.263-12a1.875 1.875 0 0 0-1.865-1.679H16.5V6a4.5 4.5 0 1 0-9 0ZM12 3a3 3 0 0 0-3 3v.75h6V6a3 3 0 0 0-3-3Zm-3 8.25a3 3 0 1 0 6 0v-.75a.75.75 0 0 1 1.5 0v.75a4.5 4.5 0 1 1-9 0v-.75a.75.75 0 0 1 1.5 0v.75Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <h1>Welcome <?php echo isset($_SESSION['user'])? $_SESSION['user'] : $user -> getPseudo(); ?></h1>
    <div class='page'>
        <div class='slider'>
            <img class='slider-item' src="../asset/test1.png" alt="1">
            <img class='slider-item' src="../asset/test2.png" alt="1">
            <img class='slider-item' src="../asset/test3.png" alt="1">
        </div>

        <div class='side-marge'>
            <h2>PROCHAINEMENT...</h2>
        </div>

        <div class='caroussel'>
            <div class="caroussel-item">t</div>
            <div class="caroussel-item">e</div>
            <div class="caroussel-item">e</div>
            <div class="caroussel-item">s</div>
        </div>  

        <div class='side-marge'>
            <h2>BEST-SELLER</h2>
        </div>

        <div class="podium">
            <div class="pod deux">
                2
            </div>
            <div class="pod un">
                1
            </div>
            <div class="pod trois">
                3
            </div>
        </div>
    </div>
    
</body>
</html>