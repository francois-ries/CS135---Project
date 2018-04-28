<?php
  session_start();
  require_once("model/register_model.php");
  // require_once('routes.php');

  class RegisterController {
    public function register() {

        $result = RegisterModel::get_register();
    
        if ($result == 'success'){
          
          // include_once( 'view/login.php');
          // echo "<h1 class='h3 mb-3 font-weight-normal'> register success </h1>";
          header('Location: http://localhost:8888/CS135---Project/?controller=login&action=login');
          // echo "<script>document.getElementById('message').innerHTML = 'Register Success';</script>";

          return;
          
        }

        else if ($result == 'failed') {
          // include_once( 'view/error.php');
          // echo "<h1 class='h3 mb-3 font-weight-normal'> Register failed </h1>";
          
          include_once("view/register.php");
          echo "<script>document.getElementById('register_message').innerHTML = 'Register failed';</script>";
          //return call('register', 'register');
          return;
        }

        else if ($result == 'user existed') {
          
          // include_once("view/login.php");
          include_once("view/register.php");
          echo "<script>document.getElementById('register_message').innerHTML = 'User has already registered, please go back to log in ';</script>";
          // header('Location: http://localhost:8888/CS135---Project/?controller=login&action=login');
          

          return;
          
        }
        else{
          include_once("view/register.php");
        }
    }
    
  }
?>