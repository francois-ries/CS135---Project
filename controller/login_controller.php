<?php
  session_start();
  require_once("model/login_model.php");
  //require_once('routes.php');

  class LoginController {
  
    public function login() {
      
      $result= LoginModel::getlogin();

      if ($result == 'register'){
        header('Location: http://localhost:8888/CS135---Project/?controller=register&action=register');
        include_once("view/register.php");
        
      }

      else if($result == 'login') {
        // include 'view/UserBooking.php';
        // header('Location: http://localhost:8888/CS135---Project/view/UserBooking.php'); 
        // header("Location: hhttp://localhost:8888/CS135---Project/view/UserBooking.php");
        
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
        // echo "<div text-align ='center' color = 'red'>Invalid login <div>  ";      
        include_once("view/login.php");
        echo "<script>document.getElementById('message').innerHTML = 'Invalid Login';</script>";
        // echo "<script>  $('#message').text('Invalid Login'); <script>";
      }
      
      else{
        // echo "include view login ";
        echo "<script>document.getElementById('message').innerHTML = 'Something is wrong';</script>";
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