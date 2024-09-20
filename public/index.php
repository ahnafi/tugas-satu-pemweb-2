<?php

include_once __DIR__ ."/../vendor/autoload.php";
use todolist\App\Router;
use todolist\Controller\TaskController;

Router::Add("GET","/",TaskController::class,"index");
Router::Add("GET","/add",TaskController::class,"create");
Router::Add("POST","/add",TaskController::class,"postCreate");
Router::Add("GET","/update/(\d+)",TaskController::class,"update");
Router::Add("POST","/update/(\d+)",TaskController::class,"postUpdate");
Router::Add("POST","/",TaskController::class,"postDelete");

Router::Run();