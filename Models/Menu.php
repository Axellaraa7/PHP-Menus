<?php
namespace Models;

require_once("/9TESTS/1.S2Next/Models/Model.php");
use Models\Model;

class Menu extends Model{
  protected $props;

  public function __construct(protected $id = null, protected $name = null, protected $description = null){
    $this->table = "menus";
    $this->props = array();
  }

  public function create($data){
    $sql = "INSERT INTO ".$this->table." (name,description) VALUES (?,?)";
    return $this->preparedStatement($sql,$data);
  }

  public function read(){
    $this->makeConnection();
    $sql = "SELECT * FROM ".$this->table." ORDER BY id";
    $rows = $this->connection->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    $this->destroyConnection();
    return $rows;
  }

  public function readById($data){
    $sql = "SELECT * FROM ".$this->table." WHERE id = ?";
    $this->preparedStatement($sql,$data);
    $this->props = $this->prepared->fetch();
    $this->id = $this->props["id"];
    $this->name = $this->props["name"];
    $this->description = $this->props["description"];
  }

  public function update($data){
    $sql = "UPDATE ".$this->table." SET name = ?, description = ? WHERE id = ?";
    return $this->preparedStatement($sql,$data);
  }

  public function delete($data){
    $sql = "DELETE FROM ".$this->table." WHERE id = ?";
    return $this->preparedStatement($sql,$data);
  }

  public function makeRelation($data){
    $sql = "SELECT sub.id,sub.name FROM submenus AS sub INNER JOIN ".$this->table." AS men ON men.id = sub.id_menus WHERE men.id = ? ORDER BY sub.id_menus;";
    $this->preparedStatement($sql,$data);
    $this->props = $this->prepared->fetchAll(\PDO::FETCH_ASSOC);
    return $this->props;

  }
  public function setId($setter){ $this->id=$setter; }
  public function setName($setter){ $this->name=$setter; }
  public function setDescription($setter){ $this->description=$setter; }
  public function getId(){ return $this->id; }
  public function getName(){ return $this->name; }
  public function getDescription(){ return $this->description; }
}