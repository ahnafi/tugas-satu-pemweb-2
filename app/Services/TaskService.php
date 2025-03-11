<?php

namespace sulthon\Services;

class TaskService
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function create(TaskCreateRequest $request): TaskCreateResponse
    {
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
            throw new \Exception(" error message : " . $exception->getMessage());
        }
    }

    public function readAll(): array
    {
        try {
            return $this->taskRepository->showAll();
        } catch (\PDOException $exception) {
            throw new \Exception(" error message : " . $exception->getMessage());
        }
    }

    public function validateTaskCreateRequest(TaskCreateRequest $request): void
    {

        if ($request->title == null || $request->title == "" || strlen($request->title) > 255 || $request->description == null  || $request->due_date == null || $request->due_date == "") {
            throw new ValidationException("task must have title, description, and due date");
        }
    }

    public function update(Task $newTask): void
    {

        $oldTask = $this->taskRepository->find($newTask->id);

        $this->validateTaskUpdateRequest($oldTask, $newTask);

        try {
            Database::beginTransaction();
            $this->taskRepository->update($newTask);
            Database::commitTransaction();
        } catch (\PDOException $exception) {
            Database::rollbackTransaction();
            throw new \Exception(" error message : " . $exception->getMessage());
        }
    }

    public function validateTaskUpdateRequest(Task $oldTask, Task $task): void
    {
        if (!$oldTask) {
            throw new ValidationException("task not found");
        }
        if ($task->title == null || $task->title == "" || strlen($task->title) > 255 || $task->description == null || $task->due_date == null || $task->due_date == "" || $task->id == null || $task->id == "") {
            throw new ValidationException("task must have title, description, and due date");
        }

        if ($oldTask->title == $task->title && $oldTask->description == $task->description && $oldTask->due_date == $task->due_date) {
            throw new ValidationException("task must have different title, description, or due date");
        }
    }

    public function find(int $id): ?Task
    {
        if ($id == null || $id == "") {
            throw new ValidationException("task id must be filled");
        }

        try {
            return $this->taskRepository->find($id);
        } catch (\PDOException $exception) {
            throw new \Exception(" error message : " . $exception->getMessage());
        }
    }

    public function delete(int $id): void
    {
        if ($id == null || $id == "") {
            throw new ValidationException("task id must be filled");
        }

        $task = $this->taskRepository->find($id);

        if (!$task) {
            throw new ValidationException("task not found");
        }

        try {
            Database::beginTransaction();
            $this->taskRepository->remove($task->id);
            Database::commitTransaction();
        } catch (\PDOException $exception) {
            Database::rollbackTransaction();
            throw new \Exception(" error message : " . $exception->getMessage());
        }
    }
}
