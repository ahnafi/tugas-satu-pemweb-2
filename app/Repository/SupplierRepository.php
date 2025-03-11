<?php

namespace sulthon\Repository;

use PDO;
use sulthon\Domain\Supplier;

class SupplierRepository
{
    private ?PDO $connection = null;

    public function __construct(?PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Supplier $supplier): void
    {
        $sql = "INSERT INTO suppliers (name,contact) VALUES (?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$supplier->name, $supplier->contact]);
    }

    public function getAll(): array
    {
        $sql = "SELECT id,name,contact FROM suppliers";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        try {
            $data = [];
            while ($rows = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $row = new Supplier();
                $row->id = $rows['id'];
                $row->name = $rows['name'];
                $row->contact = $rows['contact'];

                $data[] = $row;
            }
            return $data;
        } finally {
            $stmt->closeCursor();
        }
    }

    public function find(int $id): ?Supplier
    {
        $sql = "SELECT id,name,contact FROM suppliers WHERE id = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$id]);

        try {
            if ($rows = $statement->fetch(\PDO::FETCH_ASSOC)) {
                $supplier = new Supplier();
                $supplier->id = $rows['id'];
                $supplier->name = $rows['name'];
                $supplier->contact = $rows['contact'];

                return $supplier;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function update(Supplier $supplier): void
    {
        $sql = "UPDATE suppliers SET name=?,contact=? WHERE id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$supplier->name, $supplier->contact, $supplier->id]);
    }

    public function delete(int $id): void
    {
        $sql = "DELETE FROM suppliers WHERE id=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
    }

}