<?php

namespace todolist\Repository;

use todolist\Domain\Task;

class TaskRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Task $task): Task
    {
        $statement = $this->connection->prepare(
            "INSERT INTO tasks (title, description, due_date,status,priority) VALUES (?, ?, ?, ?, ?)"
        );
        $statement->execute([
            $task->title,
            $task->description,
            $task->due_date,
            $task->status,
            $task->priority
        ]);

        // ambil id dari task yang baru saja dibuat
        $task->id = (int)$this->connection->lastInsertId();

        return $task;
    }

    public function removeAll():void {
        $this->connection->exec("DELETE FROM tasks");
    }
}
