<?php
spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class); // Mengubah namespace menjadi path file
    require_once __DIR__ . '/../class/' . $class . '.php';
});