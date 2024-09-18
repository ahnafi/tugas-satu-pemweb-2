<?php 
namespace todolist\Controller;

use todolist\App\View;
use todolist\Config\Database;
use todolist\Model\TaskCreateRequest;
use todolist\Repository\TaskRepository;
use todolist\Services\TaskService;

class TaskController
{

    private TaskService $taskService;

    public function __construct(){
        $connection = Database::getConnection("prod");
        $userRepository = new TaskRepository($connection);
        $this->taskService = new TaskService($userRepository);
    }

    public function index()
    {
        View::render("index",["title"=>"Todo List"]);
    }

    public function postCreate(){
        $task = new TaskCreateRequest();
        
    }
}