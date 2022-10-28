<?php
namespace Controllers;
require_once(__DIR__."/../Controllers/Controller.php");
require_once(__DIR__."/../Models/Menu.php");
use Models\Menu;


class MenuController extends Controller{
  public function __construct(){
    $this->model = new Menu();
  }

  public function makeRelation($data){
    return $this->model->makeRelation($data);
  }

  public function setId($setter){ $this->model->setId($setter); }
  public function setName($setter){ $this->model->setName($setter); }
  public function setDescription($setter){ $this->model->setDescription($setter); }
  public function getId(){ return $this->model->getId(); }
  public function getName(){ return $this->model->getName(); }
  public function getDescription(){ return $this->model->getDescription(); }
}