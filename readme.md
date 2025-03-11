# Soal Urut NIM 6: Manajemen Data Penjualan

>Kasus: Kembangkan aplikasi manajemen data supplier. Aplikasi harus mendukung operasi CRUD pada data supplier.
>Gunakan PDO untuk koneksi database, Bootstrap untuk antarmuka pengguna, dan DataTables untuk menampilkan data supplier.

```sql
--Struktur Tabel
--Tabel suppliers:


CREATE TABLE suppliers
(
    id      INT PRIMARY KEY AUTO_INCREMENT,
    name    VARCHAR(255) NOT NULL,
    contact VARCHAR(100)
);
--Tabel products:

CREATE TABLE products
(
    id          INT PRIMARY KEY AUTO_INCREMENT,
    name        VARCHAR(255) NOT NULL,
    supplier_id INT,
    FOREIGN KEY (supplier_id) REFERENCES suppliers (id)
);
```
