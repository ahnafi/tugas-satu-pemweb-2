<?php

namespace sulthon\Repository;

use PDO;
use sulthon\Domain\Product;


class ProductRepository
{
    private ?PDO $connection = null;

    public function __construct(?PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Product $product): Product
    {
        $sql = "INSERT INTO products (name,supplier_id) VALUES (?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$product->name, $product->supplierId]);
        return $product;
    }

    public function getAll(): array
    {
        $sql = "SELECT p.id, p.name, p.supplier_id, s.name AS supplier_name 
            FROM products p
            JOIN suppliers s ON p.supplier_id = s.id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        try {
            $data = [];
            while ($rows = $stmt->fetchAll(\PDO::FETCH_ASSOC)) {
                $row = new Product();
                $row->id = $rows['id'];
                $row->name = $rows['name'];
                $row->supplierId = $rows['supplier_id'];
                $row->supplierName = $rows['supplier_name'];

                $data[] = $row;
            }
            return $data;
        } finally {
            $stmt->closeCursor();
        }
    }

    public function find(int $id): ?Product
    {
        $sql = "SELECT p.id, p.name, p.supplier_id, s.name AS supplier_name 
            FROM products p
            JOIN suppliers s ON p.supplier_id = s.id
            WHERE p.id = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
                $product = new Product();
                $product->id = $row['id'];
                $product->name = $row['name'];
                $product->supplierId = $row['supplier_id'];
                $product->supplierName = $row['supplier_name'];

                return $product;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function update(Product $product): void
    {
        $sql = "UPDATE products SET name=? WHERE id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$product->name, $product->id]);
    }

    public function delete(int $id): void
    {
        $sql = "DELETE FROM products WHERE id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
    }

}