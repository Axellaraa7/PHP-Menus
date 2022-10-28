<?php
require_once("/9TESTS/1.S2Next/Controllers/MenuController.php");
require_once("/9TESTS/1.S2Next/Controllers/SubmenuController.php");
$controller = "\Controllers\\".$_GET["type"]."Controller";
$obj = new $controller;
$exec = $obj->delete(array($_GET["id"]));
header("Location: ./index.php?success=$exec");