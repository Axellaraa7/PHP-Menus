<?php
namespace Controllers;
require_once("/9TESTS/1.S2Next/Models/Submenu.php");
use Models\Submenu;

class SubmenuController extends MenuController{
  public function __construct(){
    $this->model = new Submenu();
  }
  public function setIdMenu($setter){ $this->model->setIdMenu($setter); }
  public function getIdMenu(){ return $this->model->getIdMenu(); }
}