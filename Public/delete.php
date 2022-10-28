<?php
require_once(__DIR__."/../Controllers/MenuController.php");
require_once(__DIR__."/../Controllers/SubmenuController.php");
$controller = "\Controllers\\".$_GET["type"]."Controller";
$obj = new $controller;
$exec = $obj->delete(array($_GET["id"]));
header("Location: ./index.php?success=$exec");