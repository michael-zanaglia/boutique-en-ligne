<?php 
    require "../classes/user.php";
    require "../classes/basket.php";
    require "../classes/order.php";
    session_start();
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $basket = new Basket();
        $order = new Order();
        $user = new User($_SESSION['user']);
        $id_user = $user -> getId();
        $myArticles = $_POST; 
        $time = time();
        $alpbt = range("A", "Z");
        $str = "";
        foreach($alpbt as $char){
            $str .= $char;
        }
        $str = str_shuffle($str);
        $order_reference = $id_user['id'].$time.substr($str, 0, 5);
        $total = $myArticles['total'];
        $keyProd = array_keys($myArticles['id']);
        foreach($keyProd as $k){
           $quantite = $myArticles['quant'][$k];
           $id_product = $myArticles['id'][$k];
           $response = $order -> addToOrderDatabase($order_reference, date('Y-m-d'), $quantite, $id_product, $id_user['id'], $total);
        }
        if($response){
            $basket -> deleteMyBasket($id_user['id']);
        }
       
   }
   echo json_encode(["success" => true]);