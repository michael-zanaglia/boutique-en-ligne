<?php
    require "../classes/product.php";
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $product = new Product();
        $res = $product -> getAllProduct();
        echo json_encode($res);
    }