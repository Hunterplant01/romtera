<?php
include 'koneksi.php';
$id  = (int)$_POST['product_id'];
$qty = max(1, (int)$_POST['qty']);
$p = $koneksi->query("SELECT id,name,price,image FROM products WHERE id=$id")->fetch_assoc();
if(!$p){ header("Location: shop.php"); exit; }
$cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
if(isset($cart[$id])){
    $cart[$id]['qty'] += $qty;
} else {
    $cart[$id] = [
        'name'  => $p['name'],
        'price' => $p['price'],
        'image' => $p['image'],
        'qty'   => $qty
    ];
}
setcookie('cart', json_encode($cart), time() + (86400 * 7), "/");
header("Location: cart.php");
?>
