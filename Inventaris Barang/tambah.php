<?php
session_start();
include 'koneksi.php';
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $tanggal = $_POST['tanggal'];

    $koneksi->query("INSERT INTO barang (nama_barang, kategori_id, jumlah_stok, harga_barang, tanggal_masuk)
                     VALUES ('$nama','$kategori','$stok','$harga','$tanggal')");
    $_SESSION['msg'] = "Barang berhasil ditambahkan!";
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<?php include 'navbar.php'; ?>
<h2>Tambah Barang</h2>
<form method="post">
    <input name="nama" class="form-control mb-2" placeholder="Nama Barang" required>
    <select name="kategori" class="form-control mb-2" required>
        <option value="">Pilih Kategori</option>
        <?php
        $kat = $koneksi->query("SELECT * FROM kategori");
        while($k = $kat->fetch_assoc()){
            echo "<option value='{$k['id_kategori']}'>{$k['nama_kategori']}</option>";
        }
        ?>
    </select>
    <input type="number" name="stok" min="0" class="form-control mb-2" placeholder="Stok" required>
    <input type="number" name="harga" min="0" class="form-control mb-2" placeholder="Harga"required>
    <input type="date" name="tanggal" class="form-control mb-2" required>
    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>

</form>
</body>
</html>