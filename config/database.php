<?php

function getDatabaseConfig(): array
{
    return [
        "database" => [
            "test" => [
                "url" => "mysql:host=localhost:3306;dbname=",
                "username" => "",
                "password" => ""
            ],
            "prod" => [
                "url" => "mysql:host=localhost;dbname=manajemen_data_supplier",
                "username" => "root",
                "password" => ""
            ]
        ]
    ];
}