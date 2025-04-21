<?php
session_start();
include 'koneksi.php';
$id = $_GET['id'];
$koneksi->query("DELETE FROM barang WHERE id_barang = $id");
$_SESSION['msg'] = "Barang berhasil dihapus!";
header("Location: index.php");
?>

