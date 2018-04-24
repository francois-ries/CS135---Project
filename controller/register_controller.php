<?php
  session_start();
  include_once("model/register_model.php");

  class RegisterController {

    public function register() {
      
      $result = RegisterController::register();
  
      if ($result == 'success'){
        include_once( 'view/login.php');
      }
      else {
        include_once( 'view/error.php');
      }
    }
  }
?>