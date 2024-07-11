<?php
    require_once "../classes/basket.php"; 

    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        $basket = new Basket();
        $user= $_POST['user'];
        $product = $_POST['id'];
        $quant = $_POST['quant'];
        $basket -> deleteArticleFromMyBasket($user, $product, $quant);
        echo json_encode(['success' => true]);
    }