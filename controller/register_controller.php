<?php
  session_start();
  require_once("model/register_model.php");

  class RegisterController {

    public function register() {
      //include_once('view/register.php');
      echo "called register controller register function";

      if(isset($_POST['register_submit'])){
      
        $result = RegisterModel::get_register();
    
        if ($result == 'success'){
          
          // include_once( 'view/login.php');
          echo "register success";

          return call('login', 'login');
        }

        else if ($result == 'failed') {
          // include_once( 'view/error.php');
          echo  "register failed";
          
          return call('register', 'register');
        }

        else if ($result == 'user existed') {
          // include_once( 'view/login.php');
          echo  "user existed";
          return call('login', 'login');
          
        }
      }
      else{

        include_once("view/register.php");

      }
    }
  }
?>