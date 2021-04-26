<?php
require 'config.php';
spl_autoload_register();

use App\Controller\NodeTreeController as NodeTreeController;

$controller = (new NodeTreeController())->getNodeTree();
$controller->handle();



