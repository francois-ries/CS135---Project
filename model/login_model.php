<?php
// connect to database 
// require 'dbConnect.php';
// $conn = connect_to_db('crs');

class Model {

	public function getlogin()
 	{
		// return "cool" ;
		// here goes some hardcoded values to simulate the database
		if(isset($_REQUEST['register'])){
			return 'register';

		}

		if($_REQUEST['sid']=='admin' && $_REQUEST['password']=='admin'){
			return 'login';
		}

		
  		if(isset($_REQUEST['sid']) && isset($_REQUEST['password'])){
			// for easy log in for testing 
			if($_REQUEST['sid']=='admin' && $_REQUEST['password']=='admin'){
				return 'login';
			}

			// extract variables
			$sid = mysql_real_escape_string($_REQUEST['sid']);
			$password = mysql_real_escape_string($_REQUEST['password']);

			// check database
			$login_query = "SELECT fname from Users where sid =? and password = ? and admin = false";
			$login_stmt = mysqli_prepare($conn, $login_query);
			mysqli_stmt_bind_param($login_stmt,"ss", $sid, $password);
			
			$login_stmt->execute();
			$login_stmt -> bind_result($fname);

			if($login_stmt->fetch()){
				echo "Welcome, ".$fname;
				return "login";
			}else{
				// start admin log in 
				$admin_login_query = "SELECT fname from Users where sid =? and password = ? and admin = true";
				$admin_login_stmt = mysqli_prepare($conn, $admin_login_query);
				mysqli_stmt_bind_param($admin_login_stmt,"ss", $sid, $password);

				$admin_login_stmt->execute();
				$admin_login_stmt -> bind_result($fname);
				
				if($admin_login_stmt->fetch()){
					echo "Welcome Admin, ".$fname;
					return "admin";
				}else{
					return 'invalid user';
				}


			}
		}

 	}
 
}

?>