<?php
    require "classes/product.php";
    require "classes/user.php";
    require "classes/basket.php";
    $user = new User();
    $basket = new Basket();
    session_start();
    $nbArticle = 0;
    if(isset($_SESSION['user'])){
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
    $product = new Product(); 
    $allCategories = $product -> getAllCategory();
    $highestPrice = $product -> getHighestPrice();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/shop.css">
    <title>Shop</title>
</head>
<body>
    <header class='navigation'>
        <nav class='left-side'>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"stroke-width="1.5" stroke="currentColor" class="size-6 burger taille64">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
            </svg>
            <a href="/boutique-en-ligne/index.php"><img class='logo' src="../asset/logo.png" alt="FOG"></a> 
        </nav>
        <nav class='right-side'>
            <ul class='t'>
                <?php if(isset($_SESSION['user']) && $_SESSION['user'] == 'root'){
                    echo '<li><a href="admin.php">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" class="size-6 taille32">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0 0 15 0m-15 0a7.5 7.5 0 1 1 15 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077 1.41-.513m14.095-5.13 1.41-.513M5.106 17.785l1.15-.964m11.49-9.642 1.149-.964M7.501 19.795l.75-1.3m7.5-12.99.75-1.3m-6.063 16.658.26-1.477m2.605-14.772.26-1.477m0 17.726-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205 12 12m6.894 5.785-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495" />
                        </svg>
                    </a></li>';
                } ?>
                <li>
                    <a href="profile.php">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#000000" class="size-6 taille32">
                            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                        </svg> 
                    </a>
                    
                </li>
                <li>
                    <a href="panier.php" class='basket-container'>
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
                <li class='basketLi'><a href="profile.php"><h2>Mon compte</h2><div class='line'></div></a></li>
                <li class='userLi'><a href="panier.php"><h2>Mon panier</h2><div class='line'></div></a></li>
                <li><a href="bookmark.php"><h2>Vos favoris</h2><div class='line'></div></a></li>
                <li><a href="shop.php"><h2>Le shop</h2><div class='line'></div></a></li>
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
                <input class='inp' name='search' type="text" autocompletion='off' placeholder="Rechercher un de nos produits.."> 
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
        <div id='modal-bg'>
            <div id='modal'>
                <div id='close-mod'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="taille24 close size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </div>
                <div id='mod-content'>
                    <h2>Catégories</h2>
                    <div id='categories'>
                        <?php foreach($allCategories as $cat):?>
                            <div class='selection unactive-mod'><?=$cat['category_name']?></div>
                        <?php endforeach;?>
                    </div>
                    <h2>Budget</h2>
                    <div id='range'>
                        <div class='sliderValue'>
                            <span><?= round($highestPrice['price'])/2 ?></span>
                        </div>
                        <div class="field">
                            <div class="value left">0 $</div>
                            <input id='inpSlide' type="range" min="0" max="<?= round($highestPrice['price'])?>" step='20'>
                            <div class="value right"><?= round($highestPrice['price'])?> $</div>
                        </div>
                    </div>
                    <h2>Order Alphabétique</h2>
                    <div id>
                        <select id="orderBy">
                            <option value="" selected>--Select Option--</option>
                            <option value="asc">↓ A à Z</option>
                            <option value="desc">↑ Z à A</option>
                        </select>
                    </div>
                    <div class='all selection active-mod'>Tous</div>
                </div>
            </div>
        </div>
        <div class='side-marge'>
            <h2>NOS PRODUITS</h2>
        </div>
        <div id='filtre'>
            <p>Filtrer</p>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="taille24 size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
            </svg>
        </div>
        <div class='flex-container'></div>  
    </main>
    <footer>
        <div class='footer1'>
            <p>Nous suivre !</p>
            <div>
                <a href="#"><img class='Xicon' src="../asset/Xicon.png" alt="X-icon"></a>
                <a href="#"><img class='taille42' src="../asset/Instaicon.png" alt="instagram-icon"></a>
            </div>
        </div>
        <div class='footer2'>
            <p>Contact</p>
            <div>
                <button><svg class="taille32" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>Nous contacter</button>
                <button><img class="taille32" src="../asset/handshake.png" alt="handshake-icon">Nous rejoindre</button>
            </div>
        </div>
        <div class='footer3'>
            <a href="#"><p>Qui sommes-nous ?</p></a>
            <p>*Les images ne m'appartiennent pas. </p>
            <p class='copyright'>© 2024 FOG</p>
        </div>
    </footer>
    <script type='module' src='js/menu.js'></script>
    <script type='module' src='js/shop.js'></script>
</body>
</html>