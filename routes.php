<?php
  function call($controller, $action) {
    // echo '<br> controller/' . $controller . '_controller.php';
    require_once('controller/' . $controller . '_controller.php');
    // echo '<br>included controller ';

    switch($controller) {
      case 'login':
        $controller = new LoginController();
        
      break;
      case 'register':
        // we need the model to query the database later in the controller
        //
        $controller = new RegisterController();
      break;
    }
    //echo "<br> called controller";
    
    $controller->{$action}();
  }

  // we're adding an entry for the new controller and its actions
  $controllers = array('login' => ['login','error'], //,
                       'register' => ['register']
                );

  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        echo "<br> route does not recognize the controller action";
        call('login', 'error');
    }
  }else {
    call('login', 'error');
    // call('login', 'error');
  }

?>