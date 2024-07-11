<?php
    require_once "database.php";
    require_once "product.php";
    //require_once "user.php";

    class Order extends Database {
        public $_product;

        public function __construct(){
            parent::__construct(); // Call the parent constructor to initialize the database connection
            //$this -> _user = new User();
            $this -> _product = new Product();
        }

        public function addToOrderDatabase(string $order_reference, $date, int $quantite, int $id_product, int $id_user, $total){
            $req = $this -> _db -> prepare("INSERT INTO orders (order_reference, date_order, quantite, id_product, id_user, total) VALUES (?,?,?,?,?,?)");
            $result = $req -> execute([$order_reference, $date, $quantite, $id_product, $id_user, $total]); 
            return $result;
        }

        public function getOrderReference($id_user){
            $req = $this -> _db -> prepare("SELECT order_reference FROM orders WHERE id_user = ? ORDER BY date_order DESC");
            $req -> execute([$id_user]); 
            $result = $req -> fetchAll();
            return $result;
        }

        public function getTotal($order_reference){
            $req = $this -> _db -> prepare("SELECT total FROM orders WHERE order_reference = ?");
            $req -> execute([$order_reference]); 
            $result = $req -> fetch();
            return $result;
        }

        public function getArticles($order_reference){
            $req = $this -> _db -> prepare("SELECT orders.*, product.name, product.price FROM orders INNER JOIN product ON product.id = orders.id_product AND order_reference = ?");
            $req -> execute([$order_reference]);
            return $req -> fetchAll();
        }
    }

    $exportedOrder = var_export(new Order(), true);
?>