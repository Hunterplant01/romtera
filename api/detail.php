<?php
include 'koneksi.php';

$slug = $koneksi->real_escape_string($_GET['slug']);
$p = $koneksi->query("SELECT * FROM products WHERE slug='$slug'")->fetch_assoc();
if(!$p) { header("Location: shop.php"); exit; }
$imgSrc = (strpos($p['image'], 'http') === 0) ? $p['image'] : "/assets/img/products/" . $p['image'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $p['name'] ?> - Romtera Team</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
    body { background-color: #f4f6f9; }
    .product-img { object-fit: cover; min-height: 400px; width: 100%; height: 100%; }
    .btn-wa { background-color: #25D366; color: white; border: none; }
    .btn-wa:hover { background-color: #1ebe57; color: white; }
    .btn-shopee { color: #ee4d2d; border-color: #ee4d2d; }
    .btn-shopee:hover { background-color: #ee4d2d; color: white; }
    .btn-tokped { color: #03AC0E; border-color: #03AC0E; }
    .btn-tokped:hover { background-color: #03AC0E; color: white; }
</style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark mb-5 shadow-sm">
  <div class="container">
    <a class="navbar-brand fs-6" href="shop.php"><i class="bi bi-arrow-left me-2"></i> Kembali ke Katalog</a>
  </div>
</nav>

<div class="container pb-5">
  <div class="card shadow border-0 rounded-4 overflow-hidden">
    <div class="row g-0">
      <!-- Gambar Produk -->
      <div class="col-md-5 bg-white text-center">
        <img src="<?= $imgSrc ?>" class="product-img" alt="<?= $p['name'] ?>">
      </div>
      
      <!-- Informasi Produk -->
      <div class="col-md-7 p-4 p-md-5 bg-white">
        <h2 class="fw-bold mb-2"><?= $p['name'] ?></h2>
        <span class="badge bg-secondary mb-3 fs-6 px-3 py-2">Merek: <?= htmlspecialchars($p['brand']) ?></span>
        <h3 class="text-danger fw-bold mb-4">Rp <?= number_format($p['price'],0,",",".") ?></h3>

        <div class="mb-4">
          <h5 class="fw-bold border-bottom pb-2">Deskripsi Lengkap</h5>
          <p style="line-height: 1.8; color: #4a4a4a;" class="mt-3">
            <?= nl2br(htmlspecialchars($p['description'])) ?>
          </p>
        </div>
        
        <p class="mb-5"><i class="bi bi-box-seam text-primary"></i> <strong>Stok Tersedia:</strong> <?= $p['stock'] ?> unit</p>

        <!-- Tombol Aksi (Call to Action) -->
        <div class="bg-light p-4 rounded-4 border">
          <h5 class="fw-bold mb-3 text-center">Tertarik dengan produk ini?</h5>
          
          <?php 
          // Format pesan WhatsApp otomatis
          $pesan_wa = "Halo Romtera Team, saya melihat produk *" . $p['name'] . "* di website. Apakah stoknya masih tersedia?";
          $wa_link = "https://wa.me/6285700437378?text=" . urlencode($pesan_wa);
          ?>
          
          <div class="d-grid gap-2 d-md-flex justify-content-md-center">
             <a href="<?= $wa_link ?>" target="_blank" class="btn btn-wa btn-lg rounded-pill px-4 fw-bold shadow-sm">
               <i class="bi bi-whatsapp"></i> Pesan via WhatsApp
             </a>
          </div>
          
          <div class="text-center mt-3 mb-3 text-muted small">&mdash; ATAU BELI MELALUI &mdash;</div>
          
          <div class="d-flex flex-wrap justify-content-center gap-2">
             <a href="https://shopee.co.id/Romtera.team" target="_blank" class="btn btn-outline-danger btn-shopee rounded-pill px-4">
               <i class="bi bi-bag-fill"></i> Shopee
             </a>
             <a href="https://www.tokopedia.com/romtera.team" target="_blank" class="btn btn-outline-success btn-tokped rounded-pill px-4">
               <i class="bi bi-shop"></i> Tokopedia
             </a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

</body>
</html>
