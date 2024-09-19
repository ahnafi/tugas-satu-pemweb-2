<?php

include '../vendor/autoload.php';

use todolist\Config\Database;
use todolist\Model\TaskCreateRequest;
use todolist\Repository\TaskRepository;
use todolist\Services\TaskService;

$task = new TaskCreateRequest();
$task->title = "Belajar PHP";
$task->description = "Belajar PHP MVC";
$task->due_date = "2021-12-31";

$connection = Database::getConnection("prod");
$userRepository = new TaskRepository($connection);
$taskservice = new TaskService($userRepository);

// $taskservice->create($task);

$userRepository->removeAll();