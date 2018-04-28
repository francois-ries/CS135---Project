<?php 
	//echo "<br>result : ".$_SESSION['result'];
	require_once('routes.php'); 
?>

<!DOCTYPE html>
<html lang="en" class="gr__getbootstrap_com"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <title>Log In </title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">


    <!-- js script to handle click on register  -->
    <script>
        $(function() {

        $('#login-form-link').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
        });
        $('#register-form-link').click(function(e) {
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
        });

        });
       </script>

  </head>


  <body class="text-center" data-gr-c-s-loaded="true">


	<form class="form-signin" method ='post'>
	  <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
	  <!-- <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1> --> 

      <label for="userid" class="sr-only">Student ID</label>
      <input type="userid" id="userid" name ='userid' class="form-control" placeholder="Student ID"  autofocus="">  <!--required="" -->
      
      <label for="password" class="sr-only">Password</label>
      <input type="password" id="password" name = 'password' class="form-control" placeholder="Password" ><!--required="" --> 
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>

      </div>
	 
	  <button class="btn btn-lg btn-primary btn-block" name ='submit' id = 'submit' type="submit">Sign in</button>
	  <button class="btn btn-lg btn-primary btn-block" name ='register' id ='register'  type="submit" >Register</button>
	  <!-- <a href='?controller=register&action=register'>Register </a> -->
      
    </form>

								
</body></html>
