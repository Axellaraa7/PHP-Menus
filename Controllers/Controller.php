<?php
namespace Controllers;

class Controller{
  protected $model;

  public function __construct(){
  }

  public function create($data){
    return $this->model->create($data);
  }

  public function read(){
    return $this->model->read();
  }
  
  public function readById($data){
    return $this->model->readById($data);
  }

  public function update($data){
    return $this->model->update($data);
  }

  public function delete($data){
    return $this->model->delete($data);
  }

  

  
}