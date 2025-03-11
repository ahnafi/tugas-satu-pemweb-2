<?php

namespace sulthon\Controller;

use sulthon\App\View;
use sulthon\Config\Database;
use sulthon\Domain\Supplier;
use sulthon\Exception\ValidationException;
use sulthon\Repository\SupplierRepository;
use sulthon\Services\SupplierService;

class SupplierController
{
    private SupplierService $supplierService;

    public function __construct()
    {
        $connection = Database::getConnection("prod");
        $supplierRepository = new SupplierRepository($connection);
        $this->supplierService = new SupplierService($supplierRepository);
    }


    public function index(): void
    {
        $supplier = $this->supplierService->readAll();
        View::render("supplier\index", ["title" => "Supplier List", "supplier" => $supplier]);
    }

    public function create(): void
    {
        View::render("supplier\add", ["title" => "Create Product"]);
    }

    public function postCreate()
    {
        $supplier = new Supplier();
        $supplier->name = htmlspecialchars($_POST["name"]);
        $supplier->contact = htmlspecialchars($_POST["contact"]);

        try {
            $this->supplierService->create($supplier);
            View::render("supplier/add", ["title" => "Create Task", "success" => "Supplier $supplier->name Created"]);
        } catch (ValidationException $err) {
            View::render("supplier/add", ["title" => "Create Task", "error" => $err->getMessage()]);
        }
    }

    public function update($variables)
    {
        $id = $variables[0];
        try {
            $supplier = $this->supplierService->find($id);
            View::render("supplier/update", ["title" => "Update supplier", "supplier" => $supplier]);
        } catch (\PDOException $err) {
            View::redirect("/");
        }
    }

    public function postUpdate()
    {
        $supplier = new Supplier();
        $supplier->id = (int)$_POST["id"];
        $supplier->name = htmlspecialchars($_POST["name"]);
        $supplier->contact = htmlspecialchars($_POST["contact"]);

        try {
            $this->supplierService->update($supplier);
            View::render("supplier/update", ["title" => "Update supplier", "success" => "supplier Updated", "supplier" => $supplier]);
        } catch (ValidationException $err) {
            $supplier = $this->supplierService->find($supplier->id);
            View::render("supplier/update", ["title" => "Update supplier", "error" => $err->getMessage(), "supplier" => $supplier]);
        }
    }

    public function postDelete(): void
    {
        $id = (int)$_POST["id"];

        try {
            $this->supplierService->delete($id);
            View::redirect("/");
        } catch (ValidationException $err) {
            View::redirect("/");
        }
    }

}