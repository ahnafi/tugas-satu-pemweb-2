<?php

namespace todolist\Services;

use todolist\Exception\ValidationException;
use todolist\Config\Database;
use todolist\Domain\Task;
use todolist\Model\TaskCreateRequest;
use todolist\Model\TaskCreateResponse;
use todolist\Repository\TaskRepository;

class TaskService {
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository) {
        $this->taskRepository = $taskRepository;
    }

    public function create(TaskCreateRequest $request ):TaskCreateResponse {
        $this->validateTaskCreateRequest($request);
        try {
            Database::beginTransaction();

            $task = new Task();
            $task->title = $request->title;
            $task->description = $request->description;
            $task->due_date = $request->due_date;

            $result = $this->taskRepository->save($task);
            $response = new TaskCreateResponse();
            $response->task = $result;

            Database::commitTransaction();

            return $response;
        } catch (\PDOException $exception) {
            Database::rollbackTransaction();
            throw new \Exception(" error message : ". $exception->getMessage());
        }
    }

    public function readAll():array {
        try {
            return $this->taskRepository->showAll();
        }catch (\PDOException $exception) {
            throw new \Exception(" error message : ". $exception->getMessage());
        }
    }

    public function validateTaskCreateRequest(TaskCreateRequest $request):void{
        
        if($request->title == null || $request->title == "" || strlen($request->title) > 255 || $request->description == null || $request->description == "" ){
            throw new ValidationException("task must have title, description, and due date");
        }

    }
}