<?php
  session_start();
  include_once("model/login_model.php");

  class Controller {
    public $model;
 
    public function __construct()  {  
      $this->model = new Model();
    } 

    public function invoke() {
      
      $result = $this->model->getlogin();  
  
      if ($result == 'register'){
        include_once( 'view/register.php');
      }
      else if($result == 'login') {
        // include_once( 'view/search.php');
        include_once( 'view/UserBooking.php');
      }
      else if ($result == 'admin'){
        include_once( 'view/adminview.php');
      }
      else {
        include_once( 'view/login.php');
      }
    }
  }
?>