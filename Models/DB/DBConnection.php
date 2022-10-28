<?php
namespace Models\DB;

use PDOException;

class DBConnection{
  private static $instance;
  private $config, $connection;

  private function __construct(private $database){
    $this->database = $database;
    //Add try - catch
    $this->config = require_once("/9TESTS/1.S2Next/pgsql_config.php");
    try{
      $this->connection = new \PDO(
        "pgsql:host=".$this->config["host"].
        ";port=5432;dbname=".$this->database.
        ";options='--client_encoding=UTF8'",
        $this->config["user"],
        $this->config["psw"]
      );
      $this->connection->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){ die($e->getMessage()); }
    
  }

  public static function getInstance($database){
    if(!isset(self::$instance)) self::$instance = new DBConnection($database);
    return self::$instance;
  }

  public function getConnection(){
    return $this->connection;
  }


}