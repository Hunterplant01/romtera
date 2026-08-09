<?php
if(isset($_POST['id']) && isset($_POST['qty'])){
    $id = (int)$_POST['id'];
    $qty = max(1, (int)$_POST['qty']);
    
    $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
    
    if(isset($cart[$id])){
        $cart[$id]['qty'] = $qty;
        // Perbarui cookie
        setcookie('cart', json_encode($cart), time() + (86400 * 7), "/");
    }
}
header("Location: cart.php");
?>
