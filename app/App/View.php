<?php

namespace todolist\App;

class View {
    public static function render(string $view, $model): void {
        include_once __DIR__ . "/../View/Header.php";
        include_once __DIR__ . "/../View/$view.php";
        include_once __DIR__ . "/../View/Footer.php";
    }
    public static function redirect(string $url)
    {
        header("Location: $url");
        if (getenv("mode") != "test") {
            exit();
        }
    }
}