<?php
namespace Controllers;
require_once(__DIR__."/../Models/Submenu.php");
use Models\Submenu;

class SubmenuController extends MenuController{
  public function __construct(){
    $this->model = new Submenu();
  }
  public function setIdMenu($setter){ $this->model->setIdMenu($setter); }
  public function getIdMenu(){ return $this->model->getIdMenu(); }
}