<?php

namespace sulthon\Services;

use sulthon\Config\Database;
use sulthon\Domain\Product;
use sulthon\Domain\Supplier;
use sulthon\Exception\ValidationException;
use sulthon\Repository\ProductRepository;
use sulthon\Repository\SupplierRepository;

class SupplierService
{
    private SupplierRepository $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function create(Supplier $request): Supplier
    {
//            validate ??
        try {
            Database::beginTransaction();

            $product = new Supplier();
            $product->name = $request->name;
            $product->contact = $request->contact;

            $this->supplierRepository->save($product);
            $response = new Supplier();
            Database::commitTransaction();

            return $response;
        } catch (\PDOException $exception) {
            Database::rollbackTransaction();
            throw new \Exception(" error message : " . $exception->getMessage());
        }
    }

    public function readAll(): array
    {
        try {
            return $this->supplierRepository->getAll();
        } catch (\PDOException $exception) {
            throw new \Exception(" error message : " . $exception->getMessage());
        }
    }

    public function update(Supplier $supplier): void
    {

        $oldTask = $this->supplierRepository->find($supplier->id);
        if (!$oldTask) {
            throw new ValidationException("Supplier not found");
        }

//        $this->validateSupplierUpdateRequest($oldTask, $supplier);

        try {
            Database::beginTransaction();
            $this->supplierRepository->update($supplier);
            Database::commitTransaction();
        } catch (\PDOException $exception) {
            Database::rollbackTransaction();
            throw new \Exception(" error message : " . $exception->getMessage());
        }
    }

    public function find(int $id): ?Supplier
    {
        if ($id == null || $id == "") {
            throw new ValidationException("Supplier id must be filled");
        }

        try {
            return $this->supplierRepository->find($id);
        } catch (\PDOException $exception) {
            throw new \Exception(" error message : " . $exception->getMessage());
        }
    }

    public function delete(int $id): void
    {
        if ($id == null || $id == "") {
            throw new ValidationException("supplier id must be filled");
        }

        $supplier = $this->supplierRepository->find($id);

        if (!$supplier) {
            throw new ValidationException("supplier not found");
        }

        try {
            Database::beginTransaction();
            $this->supplierRepository->delete($supplier->id);
            Database::commitTransaction();
        } catch (\PDOException $exception) {
            Database::rollbackTransaction();
            throw new \Exception(" error message : " . $exception->getMessage());
        }
    }
}