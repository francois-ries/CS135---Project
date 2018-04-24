<?php
  session_start();
  // echo "<br> Login controller  is called.";
  include_once("model/login_model.php");
  
  class LoginController {
  
    public function login() {
      // echo "<br> Login controller login function is called.";
      
      $result= LoginModel::getlogin();

      $_SESSION['result'] = $result;

      if ($result == 'register'){
        include_once( 'view/register.php');
        return call('register', 'register');
        
      }
      else if($result == 'login') {
        include_once( 'view/UserBooking.php');
        return call('user', 'book');
      }
      else if ($result == 'admin'){
        include_once( 'view/adminview.php');
        return call('admin', 'approve');
      }
      else {
        echo "weird login: ".$result;
        include_once( 'view/error.php');
      }
    }


    public function error() {
      // direct to error page
    
    }
 
    /*
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
    }*/

  }

?>