<?php
    require "../classes/basket.php";
    require "../classes/favoris.php";
    $basket = new Basket();
    $favoris = new Favoris();
    $product = new Product();
    try {
       if($_SERVER['REQUEST_METHOD'] == "POST"){
            if($_POST['action'] == 'del-fav'){
                foreach($_POST['prod'] as $articleId) {
                    $res = $favoris -> deleteArticleFromFavoris($articleId, $_POST['id']);
                }
            }
            if($_POST['action'] == 'add-fav'){
                foreach($_POST['prod'] as $articleId) {
                    $added = $basket -> addToBasketDatabase($_POST['id'], 1, $articleId);
                    if($added){
                        $stock = $product -> getStock($articleId);
                        $staying = $stock - 1;
                        $product -> UpdateStock($staying, $articleId);
                        //$res = $product -> getInfoById($articleId);
                    }
                    $res2 = $favoris -> deleteArticleFromFavoris($articleId, $_POST['id']);
                }
            }
            echo json_encode(['success' => true]);
        }  
    } catch (Exeption $e) {
        var_dump($e->getMessage());
        echo json_encode(["success" => false]);
    }
   
    