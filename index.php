<?php
/*
 include_once("controller/controller.php");

 $controller = new Controller();
 $controller->invoke();*/

  require_once('model/dbConnect.php'); // include db connection



  // Look at url to see routing information 
  
  if (isset($_GET['controller']) && isset($_GET['action'])) {
    echo "<br> controller and action is set";
  	$controller = $_GET['controller'];
    $action     = $_GET['action'];
  } 

  else {
    echo "<br>login default";
    $controller = 'login';
    $action     = 'login';   
  }

  //call($controller, $action);
  echo "<br> controller ".$controller;
  echo "<br>action ".$action;
  require_once('route.php'); 
  //require_once('view/login.php'); 
  

?>