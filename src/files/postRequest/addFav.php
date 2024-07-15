<?php
    require_once "../classes/favoris.php";
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $clicked = filter_input(INPUT_POST, 'clicked', FILTER_VALIDATE_BOOLEAN);
        $favoris = new Favoris();
        if($clicked){
            $response = $favoris -> addToFavoris($_POST['id_product'], $_POST['id_user']); 
        } else {
            $response = $favoris -> deleteArticleFromFavoris($_POST['id_product'], $_POST['id_user']); 
        }
        return true;
    }