<?php
namespace Models;

require_once(__DIR__."/../Models/DB/DBConnection.php");
use \Models\DB\DBConnection;

abstract class Model{
  protected $connection, $table, $prepared;

  abstract function create($data);
  abstract function read();
  abstract function readById($data);
  abstract function update($data);
  abstract function delete($data);

  protected function preparedStatement($sql,$data){
    $this->makeConnection();
    $this->prepared = $this->connection->prepare($sql);
    $exec = $this->prepared->execute($data);
    $this->destroyConnection();
    return $exec;
  }

  protected function makeConnection(){ $this->connection = DBConnection::getInstance("tests_projects")->getConnection(); }

  protected function destroyConnection(){ $this->connection = null; }

  
}