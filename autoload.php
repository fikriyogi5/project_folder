<?php
spl_autoload_register(function ($class) {
    $classPath = __DIR__ . '/class/class.' . $class . '.php';
    $functionPath = __DIR__ . '/functions/' . $class . '.php';

    if (file_exists($classPath)) {
        include $classPath;
    } elseif (file_exists($functionPath)) {
        include $functionPath;
    }
});