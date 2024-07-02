<?php
    require "classes/product.php";
    $product = new Product(); 
    session_start();
    if((isset($_SESSION['user']) || !isset($_SESSION['user'])) && $_SESSION['user'] !== 'root'){
        header("Location: error.php");
    }
    $res = $product -> getAllProduct();
    //echo var_dump($res);
    $categories = $product -> getAllCategory();

    if((isset($_POST['upt']))){
        $product -> updateProduct($_POST);
    }

    if((isset($_POST['del']))){
        $product -> deleteProduct($_POST);
    }

    if((isset($_POST['add']))){
        $product -> addProduct($_POST);
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
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"stroke-width="1.5" stroke="currentColor" class="size-6 taille64">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
            </svg>
            <a href="acceuil.php"><img class='logo' src="../asset/logo.png" alt="FOG"></a>
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
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#000000" class="size-6 taille32">
                            <path fill-rule="evenodd" d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 0 0 4.25 22.5h15.5a1.875 1.875 0 0 0 1.865-2.071l-1.263-12a1.875 1.875 0 0 0-1.865-1.679H16.5V6a4.5 4.5 0 1 0-9 0ZM12 3a3 3 0 0 0-3 3v.75h6V6a3 3 0 0 0-3-3Zm-3 8.25a3 3 0 1 0 6 0v-.75a.75.75 0 0 1 1.5 0v.75a4.5 4.5 0 1 1-9 0v-.75a.75.75 0 0 1 1.5 0v.75Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <div class="marge">
        <h1>Admin</h1>
    </div>

    <div class='options'>
        <div>
            <div class='opt-items'>
                <h3>Home Page</h3>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 taille32">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </div>
            <div class='tableHome'></div>
        </div>
        
        <div>
            <div class='opt-items'>
                <h3>Product Page</h3> 
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 taille32">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
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
                                echo "<form method='post'>
                                        <tr>
                                            <td><input name='name' autocomplete='off' class='tableInput' value='".$row['name']."'</td>
                                            <td><input name='description' autocomplete='off' class='tableInput' value='".$row['description']."'</td>
                                            <td><input name='stock' autocomplete='off' class='tableInput' value='".$row['stock']."'</td>
                                            <td><input name='price' autocomplete='off' class='tableInput' value='".$row['price']."'</td>
                                            <td><input name='state' autocomplete='off' class='tableInput' value='".$row['state']."'</td>
                                            <td><input name='image' autocomplete='off' class='tableInput' value='".$row['image']."'</td>
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
                                <th>Add</th>
                            </tr> 
                        </thead>
                        <tbody>
                            <form action="admin.php" method="post">
                                <tr>
                                    <td><input class='tableInput' type="text" name='add-name'></td>
                                    <td><input class='tableInput'type="text" name='add-desc'></td>
                                    <td><input class='tableInput'type="text" name='add-stock'></td>
                                    <td><input class='tableInput'type="text" name='add-price'></td>
                                    <td><input class='tableInput'type="text" name='add-state'></td>
                                    <td><input class='tableInput'type="text" name='add-img'></td>
                                    <td>
                                        <select name="add-category" id="">
                                            <?php 
                                                foreach($categories as $cat) {
                                                    echo "<option>".htmlspecialchars($cat['category_name'])."</option>";
                                                }
                                            ?>  
                                        </select>
                                    </td>
                                    <td><button name='add' type='submit'>ADD</button></td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
        
    </div>
    <script src='js/admin.js'></script>
</body>
</html>