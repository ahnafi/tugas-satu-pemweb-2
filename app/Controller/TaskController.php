<?php 
namespace todolist\Controller;

use todolist\Exception\ValidationException;
use todolist\App\View;
use todolist\Config\Database;
use todolist\Domain\Task;
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
        $task->title = htmlspecialchars($_POST["title"]);
        $task->description = htmlspecialchars($_POST["description"]);
        $task->due_date = htmlspecialchars($_POST["due_date"]);
        
        try{
            $new = $this->taskService->create($task)->task;
            View::render("add",["title"=>"Create Task","success"=>"Task $new->title Created"]);
        }catch(ValidationException $err){
            View::render("add",["title"=>"Create Task","error"=>$err->getMessage()]);
        }
    }

    public function update($variables){
        $id = $variables[0];
        try{
            $task = $this->taskService->find($id);
            View::render("update",["title"=>"Update Task","task"=>$task]);
        }catch(\PDOException $err){
            View::redirect("/");
        }
    }

    public function postUpdate(){
        $task = new Task();
        $task->id = (int)$_POST["id"];
        $task->title = $_POST["title"];
        $task->description = $_POST["description"];
        $task->due_date = $_POST["due_date"];
        
        try{
            $this->taskService->update($task);
            View::render("update",["title"=>"Update Task","success"=>"Task Updated","task"=>$task]);
        }catch(ValidationException $err){
            $task = $this->taskService->find($task->id);
            View::render("update" ,["title"=>"Update Task","error"=>$err->getMessage(),"task"=>$task]);
        }
    }

    public function postDelete(){
        $id = (int) $_POST["id"];

        try{
            $this->taskService->delete($id);
            View::redirect("/");
        }catch(ValidationException $err){
            View::redirect("/");
        }
    }
}