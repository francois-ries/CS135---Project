<?php
  session_start();
  include_once("model/login_model.php");

  class LoginController {
  
    public function login() {
      
      // render view

      $result= LoginModel::getlogin();

      if ($result == 'register'){
        // include_once( 'view/register.php');
        // include ( 'view/register.php');
        // call('register', 'register'); 
        // include_once('view/register.php');
        return call('register', 'register');

        /*
        
        if(isset($_POST['register_submit'])){
          include_once('model/register_model.php');
          $register_result = RegisterModel::get_register();
          if ($register_result == 'success'){
            //include_once( 'view/login.php');
            echo  "register success";
            call('login', 'login');
          }

          else if ($register_result == 'failed') {
            // include_once( 'view/error.php');
            echo  "register failed";
            //include  'view/error.php';
            call('login', 'error');
          }
          

          else if ($register_result == 'user existed') {
            // include_once( 'view/login.php');
            echo  "user existed";
            // call('login', 'login');
          }else{
            echo  "did not get in register ";
            // call('login', 'error');
          }
          */
        
      }

      else if($result == 'login') {
        // include 'view/UserBooking.php';
        // header('Location: http://localhost:8888/CS135---Project/view/UserBooking.php'); 
        echo "<script>\n
           window.location.href = 'view/UserBooking.php';\n
           </script>";
        //return call('user', 'book');
      }

      else if ($result == 'admin'){
        // include  'view/adminview.php';
        //  header('Location: http://localhost:8888/CS135---Project/view/adminview.php'); 
        echo "<script>\n
          window.location.href = 'view/adminview.php';\n
           </script>";
        // return call('admin', 'approve');
      }

      else if ($result == "invalid user"){
        echo "<h1 class='h3 mb-3 font-weight-normal' color = 'red'>Invalid login </h1>  ";
        include_once("view/login.php");
      }
      
      else{
        include_once('view/login.php'); 
        // return call('login', 'login');
      }

    }


    public function error() {
      // echo "weird login: ".$result;
      include_once( 'view/error.php');
    
    }

  /*
    
    public static function invoke() {
      
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
    */
  }

?>