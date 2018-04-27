<?php
  
  include_once("model/login_model.php");
  if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
  }
   
  class Controller {

    public static function invoke() {

      // render view 
      // include_once('view/login.php'); 

      $result= LoginModel::getlogin();

      if ($result == 'register'){
        // include_once( 'view/register.php');
        // include ( 'view/register.php');

        include_once("model/register_model.php");
        // include_once('view/register.php');
        
        if(isset($_POST['register_submit'])){
          // include_once('model/register_model.php');
          $register_result = RegisterModel::get_register();
          echo "register_result :  $register_result ";
          if ($register_result == 'success'){
            //include_once( 'view/login.php');
            //include_once("view/register.php");
            echo  "register success";
            // call('login', 'login');
          }

          else if ($register_result == 'failed') {
            // include_once( 'view/error.php');
           // include_once("view/register.php");
            echo  "register failed";
            include_once("view/register.php");
            //include  'view/error.php';
            // call('login', 'error');
          }
          else if ($register_result == 'user existed') {
            // include_once( 'view/login.php');
            //include_once("view/register.php");
            echo  "user existed";
            include_once("view/register.php");
            // call('login', 'login');
          }
          else {
            echo  "did not get in register ";
            include_once("view/register.php");
          }
        }
        else{          
            include_once("view/register.php");
        }
      
      }

      else if($result == 'login') {
        // include 'view/UserBooking.php';
        // header('Location: http://localhost:8888/CS135---Project/view/UserBooking.php'); 
        echo "<script>\n
           window.location.href = 'view/UserBooking.php';\n
           </script>";
        
      }

      else if ($result == 'admin'){
        // include  'view/adminview.php';
        //  header('Location: http://localhost:8888/CS135---Project/view/adminview.php'); 
        echo "<script>\n
          window.location.href = 'view/adminview.php';\n
           </script>";
      }

      else if ($result == "invalid user"){
          echo "<h1 class='h3 mb-3 font-weight-normal' color = 'red'>Invalid login </h1>  ";
          include_once("view/login.php");
      }
      else{
        include_once("view/login.php");

      }
     
    }
  }




?>