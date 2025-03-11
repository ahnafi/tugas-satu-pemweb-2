<?php

include_once __DIR__ . "/../vendor/autoload.php";

use sulthon\App\Router;
use sulthon\Controller\ProductController;
use sulthon\Controller\SupplierController;

Router::Add("GET", "/", SupplierController::class, "index");
Router::Add("GET", "/add", SupplierController::class, "create");
Router::Add("POST", "/add", SupplierController::class, "postCreate");
Router::Add("GET", "/update/(\d+)", SupplierController::class, "update");
Router::Add("POST", "/update/(\d+)", SupplierController::class, "postUpdate");
Router::Add("POST", "/", SupplierController::class, "postDelete");

Router::Run();