<?php
$cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
if(!$cart){ header("Location: shop.php"); exit; }

$pesan = "Halo, saya ingin memesan:%0A";
$total = 0;

foreach($cart as $c){
    $sub = $c['price'] * $c['qty'];
    $total += $sub;
    $pesan .= "- {$c['name']} x{$c['qty']} = Rp ".number_format($sub,0,",",".")."%0A";
}
$pesan .= "%0ATotal: Rp ".number_format($total,0,",",".");

// Bersihkan keranjang (Hapus cookie)
setcookie('cart', '', time() - 3600, "/");

$wa = "6285700437378";
header("Location: https://wa.me/{$wa}?text=$pesan");
?>
