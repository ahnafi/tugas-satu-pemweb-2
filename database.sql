-- Struktur Tabel
-- Tabel suppliers:
CREATE DATABASE manajemen_data_supplier;

CREATE TABLE suppliers
(
    id      INT PRIMARY KEY AUTO_INCREMENT,
    name    VARCHAR(255) NOT NULL,
    contact VARCHAR(100)
);

-- Tabel products:
CREATE TABLE products
(
    id          INT PRIMARY KEY AUTO_INCREMENT,
    name        VARCHAR(255) NOT NULL,
    supplier_id INT,
    FOREIGN KEY (supplier_id) REFERENCES suppliers (id)
);