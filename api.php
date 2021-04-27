<?php

use App\Controller\NodeTreeController as NodeTreeController;

/**
 * Configuration and basic spl_autoload script
 */
require 'config.php';
spl_autoload_register(function ($className, $prefix = '') {
    $pathParts = explode('\\', $className);
    $classPath = $prefix . implode(DIRECTORY_SEPARATOR, $pathParts) . '.php';

    if (file_exists($classPath)) {
        require_once $classPath;
    }
});

/**
 * Minimalistic and controller oriented boot of MVC Application
 */
$controller = new NodeTreeController();
$controller->getNodeTree();
$controller->handle();
