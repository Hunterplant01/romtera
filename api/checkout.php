<?php
$cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
if(!$cart){ header("Location: shop.php"); exit; }

$pesan = "Halo Romtera Team, saya ingin memesan alat peraga medis berikut:

";
$total = 0;

foreach($cart as $c){
    $sub = $c['price'] * $c['qty'];
    $total += $sub;
    $pesan .= "- {$c['name']} (x{$c['qty']}) = Rp ".number_format($sub,0,",",".")."
";
}
$pesan .= "
*Total Akhir: Rp ".number_format($total,0,",",".")."*

Mohon informasi ketersediaan stoknya. Terima kasih.";

setcookie('cart', '', time() - 3600, "/");

$wa = "6285700437378";
$link_wa = "https://api.whatsapp.com/send?phone={$wa}&text=" . urlencode($pesan);
header("Location: " . $link_wa);
exit;
?>