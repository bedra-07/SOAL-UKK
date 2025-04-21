<?php
session_start();
include 'koneksi.php';

$batas = 5;
$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
$mulai = ($halaman - 1) * $batas;

$query = "SELECT b.*, k.nama_kategori FROM barang b LEFT JOIN kategori k ON b.kategori_id = k.id_kategori";
if (!empty($_GET['search'])) {
    $s = $_GET['search'];
    $query .= " WHERE b.nama_barang LIKE '%$s%'";
} elseif (!empty($_GET['filter_kategori'])) {
    $f = $_GET['filter_kategori'];
    $query .= " WHERE b.kategori_id = '$f'";
}
$total = $koneksi->query($query)->num_rows;
$pages = ceil($total / $batas);
$query .= " LIMIT $mulai, $batas";
$data = $koneksi->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<?php include 'navbar.php'; ?>
<h2>Barang Tersedia</h2>

<?php if (isset($_SESSION['msg'])): ?>
<div class="alert alert-success"><?= $_SESSION['msg']; unset($_SESSION['msg']); ?></div>
<?php endif; ?>

<form method="get" class="mb-3">
    <input type="text" name="search" class="form-control mb-2" placeholder="Cari nama barang...">
    <select name="filter_kategori" class="form-control mb-2">
        <option value="">Opsi</option>
        <?php
        $kat = $koneksi->query("SELECT * FROM kategori");
        while($k = $kat->fetch_assoc()){
            echo "<option value='".$k['id_kategori']."'>".$k['nama_kategori']."</option>";
        }
        ?>
    </select>
    <button class="btn btn-secondary">Cari</button>
</form>

<a href="tambah.php" class="btn btn-warning mb-2">+ Add</a>
<a href="export_excel.php" class="btn btn-success mb-2">Export ke Excel</a>

<table class="table table-bordered">
<thead>
  <tr>
    <th style="background-color: #800000; color: white;">Nama</th>
    <th style="background-color: #800000; color: white;">Kategori</th>
    <th style="background-color: #800000; color: white;">Stok</th>
    <th style="background-color: #800000; color: white;">Harga</th>
    <th style="background-color: #800000; color: white;">Tanggal</th>
    <th style="background-color: #800000; color: white;">Aksi</th>
  </tr>
</thead>
    <?php while($d = $data->fetch_assoc()): ?>
    <tr>
        <td><?= $d['nama_barang'] ?></td>
        <td><?= $d['nama_kategori'] ?></td>
        <td><?= $d['jumlah_stok'] ?></td>
        <td><?= number_format($d['harga_barang']) ?></td>
        <td><?= $d['tanggal_masuk'] ?></td>
        <td>
            <a href="edit.php?id=<?= $d['id_barang'] ?>" class="btn btn-info btn-sm">Edit</a>
            <a href="hapus.php?id=<?= $d['id_barang'] ?>" class="btn btn-danger btn-sm">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<nav>
    <ul class="pagination">
        <?php for($i = 1; $i <= $pages; $i++): ?>
        <li class="page-item <?= $i == $halaman ? 'active' : '' ?>">
            <a class="page-link" href="?halaman=<?= $i ?>"><?= $i ?></a>
        </li>
        <?php endfor; ?>
    </ul>
</nav>

</body>
</html>