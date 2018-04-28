<?php
  function call($controller, $action) {

    require_once('controller/' . $controller . '_controller.php');

    switch($controller) {
      case 'login':
        $controller = new LoginController();
 
      break;
      case 'register':
        $controller = new RegisterController();
      break;
    }
    
    $controller->{$action}();
  }

  // we're adding an entry for the new controller and its actions
  $controllers = array('login' => ['login','error'], //,
                       'register' => ['register']);

  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        echo "<br> route does not recognize the controller action";
        call('login', 'error');
    }
  }else {
    call('login', 'error');
  }

?>