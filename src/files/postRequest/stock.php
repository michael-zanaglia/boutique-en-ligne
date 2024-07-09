<?php
    require_once "../classes/user.php"; 
    require_once "../classes/basket.php"; 
    require_once "../classes/product.php"; 
    session_start();
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        $user = new User($_SESSION['user']);
        $id_user = $user -> getId()['id'];
        $product = new Product();
        $basket = new Basket();
        $new = $_POST['new'];
        $former = $_POST['former'];
        $id = $_POST['id'];
        $delta = $former - $new; 
        // Si je veux ajouter un ou + articles, je trouve le delta entre la quantite prise avant et apres puis je soustrait le stock au delta
        $myProduct = $product -> getInfoById($id);
        if ($delta < 0) {
           $newStock = $myProduct['stock'] + $delta;
           $product -> UpdateStock($newStock, $id);
           $basket -> updateQuantite($new, $id_user, $id);
        } else if($delta > 0){
            $myProduct = $product -> getInfoById($id);
            $newStock = $myProduct['stock'] + $delta;
            $product -> UpdateStock($newStock, $id);
            $basket -> updateQuantite($new, $id_user, $id);
        }
        echo json_encode(['success' => true]);
        // En renvache si je souhaite reduire la quantite prise je recupere le delta et et je l'ajoute au stock
        //var_dump($_POST);
        //echo json_encode($send);
    }