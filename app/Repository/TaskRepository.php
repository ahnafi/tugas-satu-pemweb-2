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
            "INSERT INTO tasks (title, description, due_date) VALUES (?, ?, ?)"
        );
        $statement->execute([
            $task->title,
            $task->description,
            $task->due_date,
        ]);

        // ambil id dari task yang baru saja dibuat
        $task->id = (int)$this->connection->lastInsertId();

        return $task;
    }

    public function showAll(): array
    {
        $statement = $this->connection->prepare("SELECT * FROM tasks");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function update(Task $newTask): void
    {
        $statement = $this->connection->prepare(
            "UPDATE tasks SET title = ?, description = ?, due_date = ? WHERE id = ?"
        );
        $statement->execute([
            $newTask->title,
            $newTask->description,
            $newTask->due_date,
            $newTask->id,
        ]);
    }

    public function find(int $id): ?Task
    {
        $statement = $this->connection->prepare("SELECT * FROM tasks WHERE id = ?");
        $statement->execute([$id]);
        $task = $statement->fetch();

        if (!$task) {
            return null;
        }

        $result = new Task();
        $result->id = (int)$task['id'];
        $result->title = $task['title'];
        $result->description = $task['description'];
        $result->due_date = $task['due_date'];

        return $result;
    }

    public function remove(int $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM tasks WHERE id = ?");
        $statement->execute([$id]);
    }

    public function removeAll():void {
        $this->connection->exec("DELETE FROM tasks");
    }
}
