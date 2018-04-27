<?php
  if (isset($_GET['controller']) && isset($_GET['action'])) {
    echo "<br> controller and action is set";
  	$controller = $_GET['controller'];
    $action     = $_GET['action'];
  } 

  else {
    // echo "<br>login default";
    $controller = 'login';
    $action     = 'login';   
  }

  require_once('routes.php');

  //call($controller, $action);
  // echo "<br> controller ".$controller;
  // echo "<br>action ".$action;

  //require_once('view/login.php'); 
?>