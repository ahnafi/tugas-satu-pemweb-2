<?php 

namespace todolist\Model;

class TaskCreateRequest
{
    public string $title;
    public string $description;
    public string $priority;
    public string $status;
    public string $due_date;
}