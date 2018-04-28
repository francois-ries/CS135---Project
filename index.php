<?php
global $controller, $action;
  if (isset($_GET['controller']) && isset($_GET['action'])) {
    // echo "<br> controller and action is set";

  	$controller = $_GET['controller'];
    $action     = $_GET['action'];

  } 

  else {  
    $controller = 'login';
    $action     = 'login';   
  }

  // echo "<br> controller is $controller";
  //echo "<br> action is $action";
  
  require_once('view/layout.php'); 
?>