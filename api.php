<?php
require 'config.php';
spl_autoload_register();

use App\Controller\NodeTreeController as NodeTreeController;

$controller = new NodeTreeController();
$controller->getNodeTree();
$controller->handle();



