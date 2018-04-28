<?php
  session_start();
  require_once("model/register_model.php");
  // require_once('routes.php');

  class RegisterController {
    public function register() {
      //include_once('view/register.php');
      echo "<br> called register controller register function";
      
        $result = RegisterModel::get_register();
    
        if ($result == 'success'){
          
          // include_once( 'view/login.php');
          echo "<h1 class='h3 mb-3 font-weight-normal'> register success </h1>";
          header('Location: http://localhost:8888/CS135---Project/?controller=login&action=login');

          return;
          
        }

        else if ($result == 'failed') {
          // include_once( 'view/error.php');
          echo "<h1 class='h3 mb-3 font-weight-normal'> Register failed </h1>";
          include_once("view/register.php");
          //return call('register', 'register');
          return;
        }

        else if ($result == 'user existed') {

          echo  "user existed";
          header('Location: http://localhost:8888/CS135---Project/?controller=login&action=login');
          include_once("view/login.php");

          return;
          
        }
        else{
          echo  "include register view ";
          include_once("view/register.php");
        }
    }
    
  }
?>