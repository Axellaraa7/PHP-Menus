<?php
require_once("/9TESTS/1.S2Next/Controllers/MenuController.php");
require_once("/9TESTS/1.S2Next/Controllers/SubmenuController.php");
$controller = "\Controllers\\";
$controller .= (isset($_POST["selectMenu"])) ? "SubmenuController" : "MenuController";
foreach($_POST as $value){
  $data[] = $value;
}
$obj = new $controller;
$exec = $obj->create($data);
header("Location: ./index.php?success=$exec");