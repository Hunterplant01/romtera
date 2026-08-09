<?php
// Ambil data dari cookie (menggantikan session_start)
$cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
$total = 0;
?>
<!DOCTYPE html>
<html>
<head>
<title>Keranjang</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark mb-4">
<div class="container">
<a class="navbar-brand" href="shop.php">TOKO SEPATU</a>
</div>
</nav>

<div class="container py-4">
<h3>Keranjang Belanja</h3>

<?php if(!$cart): ?>
<div class="alert alert-warning">Keranjang belanja Anda kosong.</div>
<a href="shop.php" class="btn btn-secondary">Kembali Belanja</a>
<?php else: ?>

<div class="table-responsive">
<table class="table table-bordered align-middle">
<thead class="table-light">
<tr>
<th>Produk</th>
<th>Harga</th>
<th>Qty</th>
<th>Subtotal</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
<?php foreach($cart as $id=>$c):
$sub = $c['price'] * $c['qty'];
$total += $sub;
$imgSrc = (strpos($c['image'], 'http') === 0) ? $c['image'] : "/assets/img/products/" . $c['image'];
?>
<tr>
<td>
<img src="<?= $imgSrc ?>" width="60" class="me-2 rounded">
<?= $c['name'] ?>
</td>
<td>Rp <?= number_format($c['price'],0,",",".") ?></td>
<td>
<form action="update_cart.php" method="POST" class="d-flex">
<input type="hidden" name="id" value="<?= $id ?>">
<input type="number" name="qty" value="<?= $c['qty'] ?>" min="1" class="form-control me-2" style="width:80px;">
<button class="btn btn-sm btn-warning">Update</button>
</form>
</td>
<td>Rp <?= number_format($sub,0,",",".") ?></td>
<td>
<a href="remove_from_cart.php?id=<?= $id ?>" class="btn btn-danger btn-sm">Hapus</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

<h4 class="mt-3 text-end">Total Akhir: Rp <?= number_format($total,0,",",".") ?></h4>
<div class="text-end mt-3">
<a href="shop.php" class="btn btn-secondary me-2">Lanjut Belanja</a>
<a href="checkout.php" class="btn btn-success">Checkout ke WhatsApp</a>
</div>

<?php endif; ?>
</div>
</body>
</html>
