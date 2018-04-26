<?php
  session_start();
  include_once("model/register_model.php");

  class RegisterController {

    public function register() {
      
      $result = RegisterController::get_register();
  
      if ($result == 'success'){
        
        include_once( 'view/login.php');
        printf( "register success");

        call('login', 'login');
      }
      else if ($result == 'failed') {
        include_once( 'view/error.php');
        print( "register failed");
        
        // call('login', 'error');
      }
      else if ($result == 'user existed') {
        
        include_once( 'view/login.php');
        print( "user existed");
        call('login', 'login');
      }else{
        call('login', 'error');
      }
    }
  }
?>