<?php

namespace sulthon\Controller;

use sulthon\App\View;
use sulthon\Config\Database;
use sulthon\Repository\ProductRepository;
use sulthon\Services\ProductService;

class ProductController
{
    private ProductService $productService;

    public function __construct()
    {
        $connection = Database::getConnection("prod");
        $productRepository = new ProductRepository($connection);
        $this->productService = new ProductService($productRepository);
    }

    public function index(): void
    {
        $product = $this->productService->readAll();
        View::render("product\index", ["title" => "Product List", "product" => $product]);
    }

    public function create(): void
    {
        View::render("product\add", ["title" => "Create Product"]);
    }

}