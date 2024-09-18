<?php

namespace todolist\App;

class View {
    public static function render(string $view, $models): void {
        include_once __DIR__ . "/../View/Header.php";
        include_once __DIR__ . "/../View/$view.php";
        include_once __DIR__ . "/../View/Footer.php";
    }
}