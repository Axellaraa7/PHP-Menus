<?php
namespace Models;

require_once("/9TESTS/1.S2Next/Models/Menu.php");
use Models\Menu;

class Submenu extends Menu{
  public function  __construct(private $idMenu = null, $id = null, $name = null,$description = null){
    parent::__construct($id,$name,$description);
    $this->table = "submenus";
  }

  public function create($data){
    $sql = "INSERT INTO ".$this->table." (name,description,id_menus) VALUES (?,?,?)";
    return $this->preparedStatement($sql,$data);
  }

  public function readById($data){
    parent::readById($data);
    $this->idMenu = $this->props["id_menus"];
  }

  public function update($data){
    $sql = "UPDATE ".$this->table." SET name = ?, description = ?, id_menus = ? WHERE id = ?";
    return $this->preparedStatement($sql,$data);
  }

  public function delete($data){
    $sql = "DELETE FROM ".$this->table." WHERE id = ?";
    return $this->preparedStatement($sql,$data);
  }

  public function setIdMenu($setter){ $this->idMenu=$setter; }
  public function getIdMenu(){ return $this->idMenu; }

}