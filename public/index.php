<?php

include_once __DIR__ ."/../vendor/autoload.php";
use todolist\App\Router;
use todolist\Controller\TaskController;

Router::Add("GET","/",TaskController::class,"index");

Router::Run();