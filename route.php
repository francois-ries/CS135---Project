<?php
  function call($controller, $action) {
    // echo '<br> controller/' . $controller . '_controller.php';
    require_once('controller/' . $controller . '_controller.php');
    // echo '<br>included controller ';

    switch($controller) {
      case 'login':
        $controller = new LoginController();
        require_once('view/login.php'); 
      break;
      case 'user':
       $controller = new UserController();
        // require_once('model/register_model.php');
        // $controller = new UserController();
      break;
      case 'register':
        // we need the model to query the database later in the controller
        //require_once('model/register_model.php');
        $controller = new RegisterController();
      break;
    }
    //echo "<br> called controller";
    
    $controller->{$action}();
  }

  // call('login', 'login');

  // we're adding an entry for the new controller and its actions
  $controllers = array('login' => ['login','error'], //,
                       'register' => ['register'],
                       'user' => ['search'] 
                       //'search'=>['search'],
                       //'admin'=>['approve']
                );

  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        echo "<br> route does not recognize the controller action";
        call('login', 'error');
    }
  }else {
    // call('login', 'error');
  }

?>