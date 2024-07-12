<?php
    require_once "../classes/product.php";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $product = new Product();
        $res = $product -> getNameByCompletion($_POST['input']);
        echo json_encode($res);
    }