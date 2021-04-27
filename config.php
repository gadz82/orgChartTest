<?php
spl_autoload_register(function ($className, $prefix = '') {
    $pathParts = explode('\\', $className);
    $classPath = $prefix . implode(DIRECTORY_SEPARATOR, $pathParts) . '.php';

    if (file_exists($classPath)) {
        require_once $classPath;
    }
});


const DB_HOST = '127.0.0.1';
const DB_NAME = 'organizational_chart';
const DB_USER = 'organizational';
const DB_PASSWORD = 'organizational_chart';
