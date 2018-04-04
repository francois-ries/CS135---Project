<?php
  session_start();
  include_once("model/register_model.php");

  class Controller {
    public $model;
 
    public function __construct()  {  
      $this->model = new Model();
    } 

    public function invoke() {
      
      $result = $this->model->register();  
  
      if ($result == 'success'){
        include_once( 'view/login.php');
      }
      else {
        include_once( 'view/register.php');
      }
    }
  }
?>