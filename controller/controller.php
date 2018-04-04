<?php
    session_start();
  include_once("model/model.php");

  class Controller {
    public $model;
 
    public function __construct()  {  
      $this->model = new Model();
    } 

    public function invoke() {
      
      $result = $this->model->getlogin();  
  
      if($result == 'login') {
        include_once( 'view/Afterlogin.php');
      }
      else {
        include_once( 'view/login.php');
      }
    }
  }
?>