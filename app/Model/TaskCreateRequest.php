<?php 

namespace todolist\Model;

class TaskCreateRequest
{
    public string $title;
    public string $description;
    public string $due_date;
}