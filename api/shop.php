<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Romtera - Pusat Mannequin RJP & Alat Peraga Medis</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
    body { background-color: #f8f9fa; }
    .hero-section { background-color: #ffffff; padding: 80px 0; border-bottom: 1px solid #eaeaea; text-align: center; }
    .hero-title { color: #0056b3; font-weight: 800; }
    .product-card { transition: transform 0.2s, box-shadow 0.2s; border: none; border-radius: 12px; overflow: hidden; }
    .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    .card-img-top { object-fit: cover; height: 260px; background-color: #fff; padding: 10px; }
    .footer { background-color: #0f2d52; color: #ffffff; padding: 50px 0 20px; }
    .footer a { color: #adb5bd; text-decoration: none; transition: 0.3s; }
    .footer a:hover { color: #ffffff; }
    .social-icons a { font-size: 28px; margin: 0 12px; }
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm" style="background-color: #0056b3;">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/">ROMTERA TEAM</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link text-white" href="#katalog">Katalog Produk</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="#tentang">Kontak & Medsos</a></li>
      </ul>
    </div>
  </div>
</nav>

<section class="hero-section">
  <div class="container">
    <h1 class="display-5 hero-title mb-3">ROMTERA</h1>
    <p class="lead text-muted mb-4" style="max-width: 700px; margin: auto;">
      Media Edukasi Penanganan Tersedak
    </p>
    <p class="lead text-muted mb-4" style="max-width: 700px; margin: auto;">
      Dari tahu, menjadi mampu
    </p>
    <p class="lead text-muted mb-4" style="max-width: 700px; margin: auto;">
      ROMTERA menghadirkan pengalaman belajar penanganan tersedak melalui simulasi yang interaktif dan realistis, sehingga peserta dapat memahami dan mempraktikkan teknik pertolongan pertama dengan lebih percaya diri.
    </p>
    <p class="lead text-muted mb-4" style="max-width: 700px; margin: auto;">
Tanggap Tersedak, Selamatkan Nyawa
    </p>
    <a href="#katalog" class="btn btn-primary btn-lg rounded-pill px-4 shadow-sm" style="background-color: #0056b3; border: none;">Lihat Katalog Mannequin</a>
  </div>
</section>

<section id="katalog" class="container py-5 mt-4">
  <div class="row">
  <?php
  $q = $koneksi->query("SELECT * FROM products ORDER BY id DESC");
  while($p = $q->fetch_assoc()):
      $imgSrc = (strpos($p['image'], 'http') === 0) ? $p['image'] : "/assets/img/products/" . $p['image'];
  ?>
  <div class="col-md-4 col-lg-3 mb-4">
      <div class="card product-card h-100 shadow-sm border">
          <img src="<?= $imgSrc ?>" class="card-img-top" alt="<?= $p['name'] ?>">
          <div class="card-body d-flex flex-column text-center">
              <h5 class="card-title fw-bold fs-6 text-truncate" title="<?= $p['name'] ?>"><?= $p['name'] ?></h5>
              <p class="text-danger fw-bold fs-5 mb-3">Rp <?= number_format($p['price'],0,",",".") ?></p>
              <a href="detail.php?slug=<?= $p['slug'] ?>" class="btn mt-auto w-100 rounded-pill text-white" style="background-color: #0056b3;">Detail & Beli</a>
          </div>
      </div>
  </div>
  <?php endwhile; ?>
  </div>
</section>

<footer id="tentang" class="footer mt-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col-md-4 mb-4 text-center text-md-start">
        <h5 class="fw-bold mb-3">Romtera Team</h5>
        <p class="text-white-50 small">Penyedia perlengkapan dan alat peraga simulasi medis (Mannequin CPR) terpercaya. Mendukung kegiatan Edu Resque dengan standar terbaik.</p>
      </div>
      <div class="col-md-4 mb-4 text-center">
        <h5 class="fw-bold mb-3">Marketplace Resmi</h5>
        <div class="d-flex flex-column align-items-center gap-2">
           <a href="https://shopee.co.id/Romtera.team" target="_blank" class="btn btn-outline-light btn-sm w-75 rounded-pill"><i class="bi bi-bag-fill"></i> Shopee</a>
           <a href="https://www.tokopedia.com/romtera.team" target="_blank" class="btn btn-outline-light btn-sm w-75 rounded-pill"><i class="bi bi-shop"></i> Tokopedia</a>
        </div>
      </div>
      <div class="col-md-4 mb-4 text-center text-md-end">
        <h5 class="fw-bold mb-3">Media Sosial</h5>
        <div class="social-icons">
          <a href="https://www.instagram.com/romtera.team?igsh=anF6ZG82Z3o0ejhq" target="_blank"><i class="bi bi-instagram"></i></a>
          <a href="https://www.tiktok.com/@romtera.team?_r=1&_t=ZS-98Z7xnvFWUP" target="_blank"><i class="bi bi-tiktok"></i></a>
        </div>
      </div>
    </div>
    <div class="text-center text-white-50 small border-top pt-3" style="border-color: rgba(255,255,255,0.1) !important;">
      &copy; <?= date("Y") ?> Romtera Team. All rights reserved.
    </div>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
