<?php

namespace todolist\Domain;

interface StatusInterface
{
    public const PENDING = 'pending';
    public const COMPLETED = 'completed';
}

interface PriorityInterface
{
    public const LOW = 'low';
    public const MEDIUM = 'medium';
    public const HIGH = 'high';
}

class Task 
{
    public int $id;
    public string $title;
    public string $description;
    public string $priority;
    public string $status;
    public string $due_date;
    public string $created_at;
    public string $updated_at;
}


