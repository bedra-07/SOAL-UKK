<?php
$koneksi = new mysqli("localhost", "root", "", "data_inventaris_barang");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>