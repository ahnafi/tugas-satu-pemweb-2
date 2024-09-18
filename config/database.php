<?php

function getDatabaseConfig(): array
{
    return [
        "database" => [
            "test" => [
                "url" => "mysql:host=localhost:3306;dbname=todolist_php_test",
                "username" => "speed",
                "password" => "qwerty"
            ],
            "prod" => [
                "url" => "mysql:host=localhost:3306;dbname=todolist_php",
                "username" => "speed",
                "password" => "qwerty"
            ]
        ]
    ];
}