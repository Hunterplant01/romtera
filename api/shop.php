<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Romtera Team - Katalog Produk</title>
<!-- Memuat Bootstrap CSS & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
    /* Desain Kustom Minimalis */
    body { background-color: #f4f6f9; }
    .hero-section { background-color: #ffffff; padding: 80px 0; border-bottom: 1px solid #eaeaea; text-align: center; }
    .product-card { transition: transform 0.2s, box-shadow 0.2s; border: none; border-radius: 12px; overflow: hidden; }
    .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    .card-img-top { object-fit: cover; height: 260px; }
    .footer { background-color: #1a1d20; color: #ffffff; padding: 50px 0 20px; mt-5 }
    .footer a { color: #adb5bd; text-decoration: none; transition: 0.3s; }
    .footer a:hover { color: #ffffff; }
    .social-icons a { font-size: 28px; margin: 0 12px; }
</style>
</head>
<body>

<!-- Navigasi -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/">ROMTERA TEAM</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#katalog">Katalog</a></li>
        <li class="nav-item"><a class="nav-link" href="#tentang">Kontak & Medsos</a></li>
        <li class="nav-item"><a class="btn btn-outline-light ms-lg-3 mt-2 mt-lg-0" href="cart.php"><i class="bi bi-cart"></i> Keranjang</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section (Profil Singkat) -->
<section class="hero-section">
  <div class="container">
    <h1 class="display-5 fw-bold mb-3">Selamat Datang di Romtera Team</h1>
    <p class="lead text-muted mb-4" style="max-width: 600px; margin: auto;">
      Temukan koleksi produk terbaik dari kami dengan harga bersaing. Konsultasikan pesanan Anda langsung melalui WhatsApp atau kunjungi lapak resmi kami di Marketplace.
    </p>
    <a href="#katalog" class="btn btn-primary btn-lg rounded-pill px-4 shadow-sm">Lihat Produk</a>
  </div>
</section>

<!-- Bagian Katalog Produk -->
<section id="katalog" class="container py-5 mt-4">
  <div class="row">
  <?php
  $q = $koneksi->query("SELECT * FROM products ORDER BY id DESC");
  while($p = $q->fetch_assoc()):
      $imgSrc = (strpos($p['image'], 'http') === 0) ? $p['image'] : "/assets/img/products/" . $p['image'];
  ?>
  <div class="col-md-4 col-lg-3 mb-4">
      <div class="card product-card h-100 shadow-sm">
          <img src="<?= $imgSrc ?>" class="card-img-top" alt="<?= $p['name'] ?>">
          <div class="card-body d-flex flex-column text-center">
              <h5 class="card-title fw-bold fs-6 text-truncate"><?= $p['name'] ?></h5>
              <p class="text-danger fw-bold fs-5 mb-3">Rp <?= number_format($p['price'],0,",",".") ?></p>
              <a href="detail.php?slug=<?= $p['slug'] ?>" class="btn btn-dark mt-auto w-100 rounded-pill">Detail & Beli</a>
          </div>
      </div>
  </div>
  <?php endwhile; ?>
  </div>
</section>

<!-- Footer / Informasi Kontak -->
<footer id="tentang" class="footer mt-5">
  <div class="container">
    <div class="row mb-4">
      <!-- Deskripsi -->
      <div class="col-md-4 mb-4 text-center text-md-start">
        <h5 class="fw-bold mb-3">Romtera Team</h5>
        <p class="text-muted small">Website resmi katalog Romtera Team. Kami memberikan pelayanan terbaik, transaksi aman, dan kemudahan dalam berbelanja.</p>
      </div>
      <!-- Marketplace -->
      <div class="col-md-4 mb-4 text-center">
        <h5 class="fw-bold mb-3">Belanja via Marketplace</h5>
        <div class="d-flex flex-column align-items-center gap-2">
           <a href="https://shopee.co.id/Romtera.team" target="_blank" class="btn btn-outline-light btn-sm w-75 rounded-pill"><i class="bi bi-bag-fill"></i> Shopee</a>
           <a href="https://www.tokopedia.com/romtera.team" target="_blank" class="btn btn-outline-light btn-sm w-75 rounded-pill"><i class="bi bi-shop"></i> Tokopedia</a>
           <a href="#" target="_blank" class="btn btn-outline-light btn-sm w-75 rounded-pill"><i class="bi bi-cart-check"></i> Lazada</a>
        </div>
      </div>
      <!-- Media Sosial -->
      <div class="col-md-4 mb-4 text-center text-md-end">
        <h5 class="fw-bold mb-3">Ikuti Kegiatan Kami</h5>
        <div class="social-icons">
          <a href="https://www.instagram.com/romtera.team?igsh=anF6ZG82Z3o0ejhq" target="_blank"><i class="bi bi-instagram"></i></a>
          <a href="https://www.tiktok.com/@romtera.team?_r=1&_t=ZS-98Z7xnvFWUP" target="_blank"><i class="bi bi-tiktok"></i></a>
          <a href="#" target="_blank"><i class="bi bi-youtube"></i></a>
        </div>
      </div>
    </div>
    <div class="text-center text-muted small border-top border-secondary pt-3">
      &copy; <?= date("Y") ?> Romtera Team. All rights reserved.
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
