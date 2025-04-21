<?php
include 'koneksi.php';
header("Content-Type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Barang.xls");
?>

<table border="1">
    <tr>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Stok</th>
        <th>Harga</th>
        <th>Tanggal Masuk</th>
    </tr>

    <?php
    $data = $koneksi->query("SELECT b.*, k.nama_kategori FROM barang b LEFT JOIN kategori k ON b.kategori_id = k.id_kategori");
    while($d = $data->fetch_assoc()):
    ?>
    <tr>
        <td><?= $d['nama_barang'] ?></td>
        <td><?= $d['nama_kategori'] ?></td>
        <td><?= $d['jumlah_stok'] ?></td>
        <td><?= $d['harga_barang'] ?></td>
        <td><?= $d['tanggal_masuk'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>