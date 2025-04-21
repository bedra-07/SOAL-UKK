<?php
session_start();
include 'koneksi.php';
$id = $_GET['id'];
$data = $koneksi->query("SELECT * FROM barang WHERE id_barang = $id")->fetch_assoc();

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $tanggal = $_POST['tanggal'];

    $koneksi->query("UPDATE barang SET nama_barang='$nama', kategori_id='$kategori', jumlah_stok='$stok', harga_barang='$harga', tanggal_masuk='$tanggal' WHERE id_barang=$id");
    $_SESSION['msg'] = "Barang berhasil diupdate!";
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<?php include 'navbar.php'; ?>
<h2>Edit Barang</h2>
<form method="post">
    <input name="nama" value="<?= $data['nama_barang'] ?>" class="form-control mb-2" required>
    <select name="kategori" class="form-control mb-2" required>
        <?php
        $kat = $koneksi->query("SELECT * FROM kategori");
        while($k = $kat->fetch_assoc()){
            $sel = ($k['id_kategori'] == $data['kategori_id']) ? "selected" : "";
            echo "<option value='{$k['id_kategori']}' $sel>{$k['nama_kategori']}</option>";
        }
        ?>
    </select>
    <input type="number" name="stok" value="<?= $data['jumlah_stok'] ?>" class="form-control mb-2" required>
    <input type="number" name="harga" value="<?= $data['harga_barang'] ?>" class="form-control mb-2" required>
    <input type="date" name="tanggal" value="<?= $data['tanggal_masuk'] ?>" class="form-control mb-2" required>
    <button class="btn btn-warning" name="update">Update</button>
</form>
</body>
</html>