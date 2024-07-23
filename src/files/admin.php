<?php
//".$row['image']."
    require "classes/user.php";
    require "classes/product.php";
    require "classes/basket.php";
    require "classes/adminMiddle.php";
    $product = new Product(); 
    $basket = new Basket();
    $admin = new Admin();
    session_start();
    if((isset($_SESSION['user']) || !isset($_SESSION['user'])) && $_SESSION['user'] !== 'root'){
        header("Location: 404.php");
        exit;
    }
    
    if (isset($_SESSION['user'])){
        $user = new User($_SESSION['user']);
        $id_user = $user -> getId();
        $user -> logoutUser();
    } else {
        $user = new User();
    }
    $res = $product -> getAllProduct();
    $mid = $admin -> getAllNextProduct();//echo var_dump($res);
    $categories = $product -> getAllCategory();
    
    if((isset($_POST['upt']))){
        //var_dump($_FILES['image']);
        $product -> updateProduct($_POST, $_FILES['image']['tmp_name']);
    }
    if((isset($_POST['admin-upt']))){
        $admin -> updateNewProduct($_POST, $_FILES['image']['tmp_name']);
    }

    if((isset($_POST['del']))){
        $product -> deleteProduct($_POST);
    }
    if((isset($_POST['admin-del']))){
        $admin -> deleteNewProduct($_POST);
    }

    if((isset($_POST['add']))){
        $product -> addProduct($_POST, $_FILES['add-img']['tmp_name']);
    }
    if((isset($_POST['add-admin']))){
        $admin -> addNextProduct($_POST, $_FILES['admin-img']['tmp_name']);
    }
    $mybasket = $basket -> getNumberArticlebyId($id_user['id']);
    $nbArticle = 0;
    foreach($mybasket as $nb){
        $nbArticle += $nb['quantite'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/admin.css">
    <title>Admin</title>
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
    <div class='margeAd'><div></div><h1>Admin</h1></div>
    <div class='options'>
        <div>
            <div class='opt-items'>
                <h3>Home Page</h3>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" id="home" class="size-6 taille32">
                    <path class="pathAdn" stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </div>
            <div class='tableHome'>
                <h3>Middle Page</h3>
                <?php if($mid) : ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr> 
                        </thead>
                        <tbody>
                            <?php
                                foreach($mid as $row){
                                    echo "<form method='post' enctype='multipart/form-data'>
                                            <tr>
                                                <td><input name='name' autocomplete='on' class='tableInput' value='".$row['name']."'</td>
                                                <td><input name='description' autocomplete='on' class='tableInput' value='".$row['description']."'</td>
                                                <td><input name='image' type='file' autocomplete='off' class='tableInput' accept='image/*'></td>
                                                <td><button type='submit' class='update' name='admin-upt' value='".$row['id']."'>UPT</button></td>
                                                <td><button type='submit' class='del' name='admin-del' value='".$row['id']."'>DEL</button></td>
                                            </tr>
                                    </form>";
                                }
                            ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <h5>Vide</h5>
                <?php endif ?>
                <h3>Ajouter une case</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Add</th>
                            </tr> 
                        </thead>
                        <tbody>
                            <tr>
                                <form action="admin.php" method="post" enctype="multipart/form-data">
                                    <td><input class='tableInput' type="text" name='add-name' required></td>
                                    <td><input class='tableInput' type="text" name='add-desc' required></td>
                                    <td><input class='tableInput' type="file" name='admin-img' accept='image/*' required></td>
                                    <td><button class='add' name='add-admin' type='submit'>ADD</button></td>
                                </form>       
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
        
        <div>
            <div class='opt-items'>
                <h3>Product Page</h3> 
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" id="produits" class="size-6 taille32">
                    <path class='pathProd' stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </div> 
            <div class='tableProduct'>
        
                <h3>Produits</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Stock</th>
                            <th>Prix</th>
                            <th>State</th>
                            <th>Image</th>
                            <th>Categorie</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr> 
                    </thead>
                    <tbody>
                        <?php
                            foreach($res as $row){
                                echo "<form method='post' enctype='multipart/form-data'>
                                        <tr>
                                            <td><input name='name' autocomplete='on' class='tableInput' value='".$row['name']."'</td>
                                            <td><input name='description' autocomplete='on' class='tableInput' value='".$row['description']."'</td>
                                            <td><input name='stock' autocomplete='off' class='shortInp' value='".$row['stock']."'</td>
                                            <td><input name='price' autocomplete='off' class='shortInp' value='".$row['price']."'</td>
                                            <td><input name='state' autocomplete='off' class='shortInp' value='".$row['state']."'</td>
                                            <td><input name='image' type='file' autocomplete='off' class='tableInput' accept='image/*'></td>
                                            <td><select name='category'>";
                                            foreach($categories as $cat) {
                                                if($cat['category_name'] == $row['category_name']) {
                                                    echo "<option selected>".$row['category_name']."</option>";
                                                } else {
                                                    echo "<option>".$cat['category_name']."</option>";
                                                }
                                            }
                                            echo "</select></td>
                                            <td><button type='submit' class='update' name='upt' value='".$row['id']."'>UPT</button></td>
                                            <td><button type='submit' class='del' name='del' value='".$row['id']."'>DEL</button></td>
                                        </tr>
                                </form>";
                            }
                        ?>
                    </tbody>
                </table>
                <div>
                    <h3>Ajouter un produit</h3>
                    <table id='add-table'>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Stock</th>
                                <th>Prix</th>
                                <th>State</th>
                                <th>Image</th>
                                <th>Categorie</th>
                                <th>Add</th>
                            </tr> 
                        </thead>
                        <tbody>
                            <form action="admin.php" method="post" enctype="multipart/form-data">
                                <tr>
                                    <td><input class='tableInput' type="text" name='add-name' required></td>
                                    <td><input class='tableInput'type="text" name='add-desc' required></td>
                                    <td><input class='shortInp'type="text" name='add-stock' required></td>
                                    <td><input class='shortInp'type="text" name='add-price' required></td>
                                    <td><input class='shortInp'type="text" name='add-state'></td>
                                    <td><input class='tableInput'type="file" name='add-img' accept='image/*' required></td>
                                    <td>
                                        <select name="add-category" id="">
                                            <?php 
                                                foreach($categories as $cat) {
                                                    echo "<option>".htmlspecialchars($cat['category_name'])."</option>";
                                                }
                                            ?>  
                                        </select>
                                    </td>
                                    <td><button class='add' name='add' type='submit'>ADD</button></td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
        
    </div>
    <script type='module' src='js/menu.js'></script>
    <script src='js/admin.js'></script>
</body>
</html>