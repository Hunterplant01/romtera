<?php
$id = (int)$_GET['id'];
$cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
if(isset($cart[$id])){
    unset($cart[$id]);
    setcookie('cart', json_encode($cart), time() + (86400 * 7), "/");
}
header("Location: cart.php");
?>