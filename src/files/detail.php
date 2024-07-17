<?php
    //<a href='detail.php?id_product=<?=$_GET['id_product']?
    require "classes/product.php";
    require "classes/user.php";
    require "classes/basket.php";
    require "classes/favoris.php";
    session_start();
    if(isset($_SESSION['user'])){
        $user = new User($_SESSION['user']);
        $id_user = $user -> getId();
    } else {
        $user = new User();
    }
    $basket = new Basket();
    $product = new Product();
    $favoris = new Favoris();
    if(isset($_GET['id_product'])){
        $res = $product -> getInfoById($_GET['id_product']);
        if(!$res) {
            header("Location: 404.php");
            exit;
        }
    }
    if(isset($_POST['addToBasket'])){
        $added = $basket -> addToBasketDatabase($id_user['id'], $_POST['took'], $_GET['id_product']);
        if($added){
            $staying = $res['stock']- $_POST['took'];
            $product -> UpdateStock($staying, $_GET['id_product']);
            $res = $product -> getInfoById($_GET['id_product']);
        }
    }
    $mybasket = $basket -> getNumberArticlebyId($id_user['id']);
    $isFav = $favoris -> getFavorisArticle($_GET['id_product'], $id_user['id']);
    $nbArticle = 0;
    foreach($mybasket as $nb){
        $nbArticle += $nb['quantite'];
    }
    $user -> logoutUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/detail.css">
    <title>Détail</title>
</head>
<body>
    <header class='navigation'>
        <nav class='left-side'>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"stroke-width="1.5" stroke="currentColor" class="size-6 burger taille64">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
            </svg>
            <ul class='menu-burger'>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 leave taille32">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
                <li><a href="profile.php"><h2>Mon compte</h2><div class='line'></div></a></li>
                <li><a href="panier.php"><h2>Mon panier</h2><div class='line'></div></a></li>
                <li><a href="bookmark.php"><h2>Vos favoris</h2><div class='line'></div></a></li>
                <li><a href="shop.php"><h2>Le shop</h2><div class='line'></div></a></li>
                <?php 
                    if(isset($_SESSION['user'])){
                        echo "<li class='btn-menu'><form method='post'><button class='btn-rouge' name='deco'>Se déconnecter</button></form></li>";
                    } 
                ?>
            </ul>
            
            <a href="index.php"><img class='logo' src="../asset/logo.png" alt="FOG"></a> 
            
        </nav>
        <nav>
            <ul>
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
                        <?php if($nbArticle !== 0) :?>
                            <div class='notif-basket'><p><?=$nbArticle?></p></div>
                        <?php endif;?>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#000000" class="size-6 taille32">
                            <path fill-rule="evenodd" d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 0 0 4.25 22.5h15.5a1.875 1.875 0 0 0 1.865-2.071l-1.263-12a1.875 1.875 0 0 0-1.865-1.679H16.5V6a4.5 4.5 0 1 0-9 0ZM12 3a3 3 0 0 0-3 3v.75h6V6a3 3 0 0 0-3-3Zm-3 8.25a3 3 0 1 0 6 0v-.75a.75.75 0 0 1 1.5 0v.75a4.5 4.5 0 1 1-9 0v-.75a.75.75 0 0 1 1.5 0v.75Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <div class='search-bar'>
        <form class='form-search'>
            <div class='container-form'>
                <input class='inp' name='search' type="text" autocompletion='off' placeholder="Rechercher un de nos produits.."> 
                <button name='btn-search' type='submit'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="taille24 size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </button>
            </div>
            <div class='autocompletion'></div>
        </form>   
    </div>
    <div class='margeAd'>
        <div><input type="hidden" class='id' value='<?=$_GET['id_product']?>'><input type="hidden" class='user' value='<?=$id_user['id']?>'></div><h1>
            <?= $res['name']?>
            <svg xmlns="http://www.w3.org/2000/svg" fill=<?=$isFav? "#FF0000" : "none";?> viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="taille32 fav size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
        </h1>
    </div>
    <div class='produit'>
        <img src="<?="data:image;base64,".$res['image'] ?>" alt="img-product">
    </div>
    <p>Quantité : <span class='stockTotal'><?= $res['stock']?> </span>restante(s)</p>
    <p>Description : <?= $res['description']?></p>
    <p>Prix : <?= $res['price']?> $</p>
    <form action='detail.php?id_product=<?=$_GET['id_product']?>' method='post' id='form-add'>
        <?php if ($res['stock'] == 0): ?>
            <label id="no-stock" for="addToBasket">Notre article revient tres prochainement !</label>
        <?php endif; ?>
        <div id='howMany'>
                <button type='button' class=btn-minus>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 minus taille32">
                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm3 10.5a.75.75 0 0 0 0-1.5H9a.75.75 0 0 0 0 1.5h6Z" clip-rule="evenodd" />
                    </svg>
                </button>
                <span class="count">1</span>
                <button type='button' class=btn-plus>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 plus taille32">
                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
                    </svg>
                </button>   
        </div>
        <input type="hidden" class='took' name='took'>
        <button class=<?php echo $res["stock"] != 0 ? 'btn-vert' : "btnI";?> name='addToBasket' type='submit' id="adding" <?php echo $res['stock'] === 0 ? 'disabled' : ""; ?>>Ajouter au panier</button>
    </form>
    <footer>
        <div class='footer1'>
            <p>Nous suivre !</p>
            <div>
                <a href="#"><img class='Xicon' src="../asset/Xicon.png" alt="X-icon"></a>
                <a href="#"><img class='taille42' src="../asset/Instaicon.png" alt="instagram-icon"></a>
            </div>
        </div>
        <div class='footer2'>
            <button><svg class="taille32" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>Nous contacter</button>
            <button><img class="taille32" src="../asset/handshake.png" alt="handshake-icon">Nous rejoindre</button>
        </div>
        <div class='footer3'>
            <a href="#"><p>Qui sommes-nous ?</p></a>
            <p class='copyright'>© 2024 FOG</p>
        </div>
    </footer>
    <script type='module' src='js/menu.js'></script>
    <script type='module' src="js/detail.js"></script>
</body>
</html>