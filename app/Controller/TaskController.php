<?php 
namespace todolist\Controller;

use todolist\Exception\ValidationException;
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
        $taskRepository = new TaskRepository($connection);
        $this->taskService = new TaskService($taskRepository);
    }

    public function index()
    {
        $tasks = $this->taskService->readAll();
        View::render("index",["title"=>"Task List","tasks"=>$tasks]);
    }

    public function create (){
        View::render("add",["title"=>"Create Task"]);
    }

    public function postCreate(){
        $task = new TaskCreateRequest();
        $task->title = $_POST["title"];
        $task->description = $_POST["description"];
        $task->due_date = $_POST["due_date"];
        
        try{
            $this->taskService->create($task);
            View::render("/add",["title"=>"Create Task","success"=>"Task Created"]);
        }catch(ValidationException $err){
            View::render("/add",["title"=>"Create Task","error"=>$err->getMessage()]);
        }
    }
}