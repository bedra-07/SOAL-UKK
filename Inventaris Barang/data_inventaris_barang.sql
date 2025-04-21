CREATE DATABASE IF NOT EXISTS data_inventaris_barang;
USE data_inventaris_barang;

CREATE TABLE kategori (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL
);

CREATE TABLE barang (
    id_barang INT AUTO_INCREMENT PRIMARY KEY,
    nama_barang VARCHAR(100) NOT NULL,
    kategori_id INT,
    jumlah_stok INT NOT NULL CHECK (jumlah_stok >= 0),
    harga_barang INT NOT NULL CHECK (harga_barang >= 0),
    tanggal_masuk DATE NOT NULL,
    FOREIGN KEY (kategori_id) REFERENCES kategori(id_kategori)
);

INSERT INTO kategori (nama_kategori) VALUES
('Elektronik'),
('Furnitur');

INSERT INTO barang (nama_barang, kategori_id, jumlah_stok, harga_barang, tanggal_masuk) VALUES
('Laptop', 1, 10, 7000000, '2024-10-14');
