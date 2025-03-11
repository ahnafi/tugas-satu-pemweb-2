<?php

namespace sulthon\Services;

use sulthon\Config\Database;
use sulthon\Domain\Product;
use sulthon\Repository\ProductRepository;


class ProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function create(Product $request): Product
    {
        // $this->validateCreateProduct($request);
        try {
            Database::beginTransaction();

            $product = new Product();
            $product->name = $request->name;
            $product->supplierId = $request->supplierId;

            $result = $this->productRepository->save($product);
            $response = new Product();
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
            return $this->productRepository->getAll();
        } catch (\PDOException $exception) {
            throw new \Exception(" error message : " . $exception->getMessage());
        }
    }
}