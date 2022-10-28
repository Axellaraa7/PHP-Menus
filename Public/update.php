<?php
require_once(__DIR__."/../Controllers/MenuController.php");
require_once(__DIR__."/../Controllers/SubmenuController.php");
$controller = "\Controllers\\";
$controller .= (isset($_POST["selectMenu"])) ? "SubmenuController" : "MenuController";
foreach($_POST as $value){
  $data[] = $value;
}
print_r($data);
$obj = new $controller;
$exec = $obj->update($data);
header("Location: ./index.php?success=$exec");