<?php
    require "src/files/classes/user.php";
    require "src/files/classes/product.php";
    require "src/files/classes/basket.php";
    require "src/files/classes/adminMiddle.php";
    $admin = new Admin();
    $product = new Product();
    $basket = new Basket();
    $myImgs = $product -> getNewItems();
    $myTop = $product -> getMyTop();
    $myNextImgs = $admin -> getNextImgs();
    $nbArticle = 0;
    //var_dump($myImgs);
    //$nbrArray = count($myImgs);
    session_start();
    if (isset($_SESSION['user'])){
        $user = new User($_SESSION['user']);
        $id_user = $user -> getId();
        $user -> logoutUser();
        $mybasket = $basket -> getNumberArticlebyId($id_user['id']);
        foreach($mybasket as $nb){
            $nbArticle += $nb['quantite'];
        }
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
    <link rel="stylesheet" href="src/files/styles/style.css">
    <link rel="stylesheet" href="src/files/styles/home.css">
    <title>Acceuil</title>
</head>
<body>
    <header class='navigation'>
        <nav class='left-side'>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"stroke-width="1.5" stroke="currentColor" class="size-6 burger taille64">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
            </svg>
            <a href="index.php"><img class='logo' src="src/asset/logo.png" alt="FOG"></a> 
        </nav>
        <nav class='right-side'>
            <ul class='t'>
                <?php if(isset($_SESSION['user']) && $_SESSION['user'] == 'root'){
                    echo '<li><a href="src/files/admin.php">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" class="size-6 taille32">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0 0 15 0m-15 0a7.5 7.5 0 1 1 15 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077 1.41-.513m14.095-5.13 1.41-.513M5.106 17.785l1.15-.964m11.49-9.642 1.149-.964M7.501 19.795l.75-1.3m7.5-12.99.75-1.3m-6.063 16.658.26-1.477m2.605-14.772.26-1.477m0 17.726-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205 12 12m6.894 5.785-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495" />
                        </svg>
                    </a></li>';
                } ?>
                <li>
                    <a href="src/files/profile.php">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#000000" class="size-6 taille32">
                            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                        </svg> 
                    </a>
                    
                </li>
                <li>
                    <a href="src/files/panier.php" class='basket-container'>
                        <?php if($nbArticle !== 0 && isset($_SESSION['user'])) :?>
                            <div class='notif-basket'><p><?=$nbArticle?></p></div>
                        <?php endif;?>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#000000" class="size-6 taille32">
                            <path fill-rule="evenodd" d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 0 0 4.25 22.5h15.5a1.875 1.875 0 0 0 1.865-2.071l-1.263-12a1.875 1.875 0 0 0-1.865-1.679H16.5V6a4.5 4.5 0 1 0-9 0ZM12 3a3 3 0 0 0-3 3v.75h6V6a3 3 0 0 0-3-3Zm-3 8.25a3 3 0 1 0 6 0v-.75a.75.75 0 0 1 1.5 0v.75a4.5 4.5 0 1 1-9 0v-.75a.75.75 0 0 1 1.5 0v.75Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </li>
            </ul>
            <ul class='menu-burger'>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 leave taille32">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
                <li class='basketLi'><a href="src/files/profile.php"><h2>Mon compte</h2><div class='line'></div></a></li>
                <li class='userLi'><a href="src/files/panier.php"><h2>Mon panier</h2><div class='line'></div></a></li>
                <li><a href="src/files/bookmark.php"><h2>Vos favoris</h2><div class='line'></div></a></li>
                <li><a href="src/files/shop.php"><h2>Le shop</h2><div class='line'></div></a></li>
                <div class='computerView'>
                    <form class='form-search'>
                        <div class='container-form'>
                            <input class='inp' name='search' type="text" autocomplete='off' placeholder="Rechercher un de nos produits.."> 
                            <button name='btn-search' type='button'>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="taille24 size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </button>
                        </div>
                        <div class='autocompletion'></div>
                    </form>   
                </div>
                
                <?php 
                    if(isset($_SESSION['user'])){
                        echo "<li class='btn-menu'><form method='post'><button class='btn-rouge' name='deco'>Se déconnecter</button></form></li>";
                    } 
                ?>
            </ul> 
        </nav>
    </header>
    <div class='search-bar'>
        <form class='form-search'>
            <div class='container-form'>
                <input class='inp' name='search' type="text" autocomplete='off' placeholder="Rechercher un de nos produits.."> 
                <button name='btn-search' type='button'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="taille24 size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </button>
            </div>
            <div class='autocompletion'></div>
        </form>   
    </div>
    <main>
        <section class='page'>
            <div class='first child'>
                <div class="entete"></div>
                <h1 class="welcome">Welcome <?php echo isset($_SESSION['user'])? $_SESSION['user'] : $user -> getPseudo(); ?></h1>
                <p class='newArticle'>Cliquez pour découvrir nos dernieres figurines !</p>
                <div class='slider'>
                    <?php foreach ($myImgs as $myImg):?>
                        <a href='/boutique-en-ligne/src/files/detail.php?id_product=<?=$myImg['id']?>'><img class='slider-item' src='data:image;base64,<?=$myImg['image']?>' alt='new-img'></a>
                    <?php endforeach;?>
                </div>
            </div>
            
            <div class='child'>
                <div class='side-marge entete'>
                    <h2>PROCHAINEMENT...</h2>
                </div>

                <div class='caroussel'>
                    <?php foreach ($myNextImgs as $myNextImg) : ?>
                        <div class="caroussel-item">
                            <img src='data:image;base64,<?=$myNextImg['image']?>' alt='next-img'>
                            <div class='over'>
                                <h1 class='infoCard'><?=$myNextImg['name']?></h1>
                                <p class='infoCard'><?=$myNextImg['description']?></p>
                            </div>
                        </div>
                    <?php endforeach;?>
                    <div class="caroussel-end"></div>
                </div>  
            </div>
            
            <div class='child third-child'>
                <div class='side-marge entete'>
                    <h2>BEST-SELLER</h2>
                </div>
                <div class="podium">
                    <?php foreach($myTop as $top):?>
                        <?php if($top['state'] == 2):?>
                            <div class="srl pod deux">
                                <img class='top' src="src/asset/no2.png" alt="">
                                <a href="/boutique-en-ligne/src/files/detail.php?id_product=<?=$top['id']?>"><img class='topImg' src='data:image;base64,<?=$top['image']?>' alt='top2-img'></a>
                            </div>
                        <?php endif;?>
                        <?php if($top['state'] == 1):?>
                            <div class="srl pod un">
                                <img class='top' src="src/asset/no1.png" alt="">
                                <a href="/boutique-en-ligne/src/files/detail.php?id_product=<?=$top['id']?>"><img class='topImg' src='data:image;base64,<?=$top['image']?>' alt='top1-img'></a>
                            </div>
                        <?php endif;?>
                        <?php if($top['state'] == 3):?>
                            <div class="srl pod trois">
                                <img class='top' src="src/asset/no3.png" alt="">
                                <a href="/boutique-en-ligne/src/files/detail.php?id_product=<?=$top['id']?>"><img class='topImg' src='data:image;base64,<?=$top['image']?>' alt='top3-img'></a>
                            </div>
                        <?php endif;?>
                    <?php endforeach;?>
                </div> 
            </div>
            <footer>
                <div class='footer1'>
                    <p>Nous suivre !</p>
                    <div>
                        <a href="#"><img class='Xicon' src="src/asset/Xicon.png" alt="X-icon"></a>
                        <a href="#"><img class='taille42' src="src/asset/Instaicon.png" alt="instagram-icon"></a>
                    </div>
                </div>
                <div class='footer2'>
                    <p>Contact</p>
                    <div>
                        <button><svg class="taille32" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>Nous contacter</button>
                        <button><img class="taille32" src="src/asset/handshake.png" alt="handshake-icon">Nous rejoindre</button>
                    </div>
                </div>
                <div class='footer3'>
                    <a href="#"><p>Qui sommes-nous ?</p></a>
                    <p>*Les images ne m'appartiennent pas. </p>
                    <p class='copyright'>© 2024 FOG</p>
                </div>
        </footer>
        </section>
    </main>
    <script type='module' src='src/files/js/menu.js'></script>
    <script src='src/files/js/home.js'></script>
</body>
</html>