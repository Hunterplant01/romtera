<?php
include __DIR__ . '/../koneksi.php';
include __DIR__ . '/../upload.php';

if(isset($_POST['add'])){
    $name  = $koneksi->real_escape_string($_POST['name']);
    $brand = $koneksi->real_escape_string($_POST['brand']);
    $price = (int)$_POST['price'];
    $stock = (int)$_POST['stock'];
    $desc  = $koneksi->real_escape_string($_POST['description']);
    $slug  = strtolower(str_replace(" ","-",$name)) . "-" . time();

    $image = uploadImage($_FILES['image']); 
    $koneksi->query("INSERT INTO products (name, slug, brand, price, stock, description, image) 
                     VALUES ('$name','$slug','$brand','$price','$stock','$desc','$image')");
    header("Location: /admin/index.php");
    exit;
}

if(isset($_POST['update'])){
    $id    = (int)$_POST['id'];
    $name  = $koneksi->real_escape_string($_POST['name']);
    $brand = $koneksi->real_escape_string($_POST['brand']);
    $price = (int)$_POST['price'];
    $stock = (int)$_POST['stock'];
    $desc  = $koneksi->real_escape_string($_POST['description']);

    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){
        $img = uploadImage($_FILES['image']);
        $koneksi->query("UPDATE products SET name='$name', brand='$brand', price='$price', stock='$stock', description='$desc', image='$img' WHERE id=$id");
    } else {
        $koneksi->query("UPDATE products SET name='$name', brand='$brand', price='$price', stock='$stock', description='$desc' WHERE id=$id");
    }
    header("Location: /admin/index.php");
    exit;
}

if(isset($_GET['delete'])){
    $id = (int)$_GET['delete'];
    $koneksi->query("DELETE FROM products WHERE id=$id");
    header("Location: /admin/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Romtera - Mannequin CPR</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<style> body { background-color: #f4f6f9; } </style>
</head>
<body>

<nav class="navbar navbar-dark shadow-sm mb-4" style="background-color: #0056b3;">
<div class="container">
<a class="navbar-brand fw-bold" href="/">ROMTERA (Lihat Web)</a>
<span class="navbar-text text-white">Panel Admin Alat Peraga</span>
</div>
</nav>

<div class="container py-4">
<h3 class="fw-bold" style="color: #0056b3;">Manajemen Produk Mannequin & Medis</h3>
<p class="text-muted">Kelola data produk yang akan tampil di halaman pengunjung (Vercel + TiDB).</p>

<button class="btn btn-primary mb-4" style="background-color: #0056b3;" data-bs-toggle="modal" data-bs-target="#addModal">
+ Tambah Alat Peraga Baru
</button>

<div class="card shadow-sm border-0 p-3">
<div class="table-responsive">
<table id="table" class="table table-bordered table-hover align-middle">
<thead class="table-light">
<tr>
<th>Foto</th>
<th>Nama Alat/Mannequin</th>
<th>Kategori/Tipe</th>
<th>Harga</th>
<th>Stok</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
<?php
$q = $koneksi->query("SELECT * FROM products ORDER BY id DESC");
while($p = $q->fetch_assoc()):
    $imgSrc = (strpos($p['image'], 'http') === 0) ? $p['image'] : "/assets/img/products/" . $p['image'];
?>
<tr>
<td><img src="<?= $imgSrc ?>" width="70" class="rounded border"></td>
<td class="fw-bold"><?= $p['name'] ?></td>
<td><?= $p['brand'] ?></td>
<td>Rp <?= number_format($p['price'],0,",",".") ?></td>
<td><?= $p['stock'] ?></td>
<td>
<button class="btn btn-outline-warning btn-sm editBtn mb-1"
data-id="<?= $p['id'] ?>"
data-name="<?= htmlspecialchars($p['name']) ?>"
data-brand="<?= htmlspecialchars($p['brand']) ?>"
data-price="<?= $p['price'] ?>"
data-stock="<?= $p['stock'] ?>"
data-desc="<?= htmlspecialchars($p['description']) ?>"
data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>

<a href="?delete=<?= $p['id'] ?>" onclick="return confirm('Yakin ingin menghapus produk ini?')" class="btn btn-outline-danger btn-sm mb-1">Hapus</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="addModal">
<div class="modal-dialog modal-lg">
<form method="POST" enctype="multipart/form-data" class="modal-content">
<div class="modal-header bg-light"><h5 class="fw-bold">Tambah Mannequin/Alat Peraga</h5></div>
<div class="modal-body">
<label class="form-label small fw-bold">Nama Produk</label>
<input name="name" class="form-control mb-3" placeholder="Contoh: Mannequin CPR Half Body" required>
<label class="form-label small fw-bold">Kategori/Tipe</label>
<input name="brand" class="form-control mb-3" placeholder="Contoh: Dewasa / Infant / Full Body">
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label small fw-bold">Harga (Rp)</label>
        <input name="price" type="number" class="form-control" required>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label small fw-bold">Stok (Unit)</label>
        <input name="stock" type="number" class="form-control" required>
    </div>
</div>
<label class="form-label small fw-bold">Spesifikasi & Deskripsi</label>
<textarea name="description" class="form-control mb-3" rows="4"></textarea>
<label class="form-label small fw-bold">Foto Produk (Auto-upload ke ImgBB)</label>
<input type="file" name="image" class="form-control" accept="image/*" required>
</div>
<div class="modal-footer"><button class="btn text-white" style="background-color: #0056b3;" name="add">Simpan Produk</button></div>
</form>
</div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="editModal">
<div class="modal-dialog modal-lg">
<form method="POST" enctype="multipart/form-data" class="modal-content">
<input type="hidden" name="id" id="edit_id">
<div class="modal-header bg-light"><h5 class="fw-bold">Edit Produk</h5></div>
<div class="modal-body">
<label class="form-label small fw-bold">Nama Produk</label>
<input name="name" id="edit_name" class="form-control mb-3" required>
<label class="form-label small fw-bold">Kategori/Tipe</label>
<input name="brand" id="edit_brand" class="form-control mb-3">
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label small fw-bold">Harga (Rp)</label>
        <input name="price" id="edit_price" type="number" class="form-control" required>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label small fw-bold">Stok (Unit)</label>
        <input name="stock" id="edit_stock" type="number" class="form-control" required>
    </div>
</div>
<label class="form-label small fw-bold">Spesifikasi & Deskripsi</label>
<textarea name="description" id="edit_desc" class="form-control mb-3" rows="4"></textarea>
<label class="form-label small fw-bold">Ganti Foto (Opsional)</label>
<input type="file" name="image" class="form-control" accept="image/*">
</div>
<div class="modal-footer"><button class="btn btn-warning fw-bold" name="update">Update Data</button></div>
</form>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
$('#table').DataTable();
$('.editBtn').click(function(){
$('#edit_id').val($(this).data('id'));
$('#edit_name').val($(this).data('name'));
$('#edit_brand').val($(this).data('brand'));
$('#edit_price').val($(this).data('price'));
$('#edit_stock').val($(this).data('stock'));
$('#edit_desc').val($(this).data('desc'));
});
</script>
</body>
</html>