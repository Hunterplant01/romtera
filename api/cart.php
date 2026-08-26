<?php
$cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
$total = 0;
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Keranjang Romtera</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark mb-4 shadow-sm" style="background-color: #0056b3;">
<div class="container">
<a class="navbar-brand fw-bold" href="shop.php">ROMTERA TEAM</a>
</div>
</nav>

<div class="container py-4">
<h3 class="mb-4" style="color: #0056b3; font-weight:bold;">Keranjang Pesanan</h3>

<?php if(!$cart): ?>
<div class="alert alert-warning">Keranjang Anda masih kosong.</div>
<a href="shop.php" class="btn text-white" style="background-color: #0056b3;">Kembali ke Katalog</a>
<?php else: ?>

<div class="card shadow-sm border-0 p-3">
<div class="table-responsive">
<table class="table align-middle">
<thead class="table-light">
<tr>
<th>Produk Mannequin</th>
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
$images = explode(',', $c['image']);
$first_img = trim($images[0]);
$imgSrc = (strpos($first_img, 'http') === 0) ? $first_img : "/assets/img/products/" . $first_img;
?>
<tr>
<td>
<img src="<?= $imgSrc ?>" width="60" class="me-2 rounded border bg-white">
<span class="fw-bold"><?= $c['name'] ?></span>
</td>
<td>Rp <?= number_format($c['price'],0,",",".") ?></td>
<td>
<form action="update_cart.php" method="POST" class="d-flex">
<input type="hidden" name="id" value="<?= $id ?>">
<input type="number" name="qty" value="<?= $c['qty'] ?>" min="1" class="form-control form-control-sm me-2" style="width:70px;">
<button class="btn btn-sm btn-outline-primary">Update</button>
</form>
</td>
<td class="fw-bold text-danger">Rp <?= number_format($sub,0,",",".") ?></td>
<td>
<a href="remove_from_cart.php?id=<?= $id ?>" class="btn btn-danger btn-sm">Hapus</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
<h4 class="mt-4 text-end fw-bold">Total: Rp <?= number_format($total,0,",",".") ?></h4>
<div class="text-end mt-4">
<a href="shop.php" class="btn btn-outline-secondary me-2 rounded-pill px-4">Lanjut Belanja</a>
<a href="checkout.php" class="btn btn-success rounded-pill px-4 fw-bold">Checkout via WhatsApp</a>
</div>
</div>
<?php endif; ?>
</div>
</body>
</html>
