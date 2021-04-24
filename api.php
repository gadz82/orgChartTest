<?php
require 'config.php';
spl_autoload_register();
use \App\Controller\NodeTreeController as NodeTreeController;
use \App\Library\Request as Request;

$controller = (new NodeTreeController(new Request()))->getNodeTree();
$controller->handle();



