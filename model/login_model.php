<?php
session_start(); 
// echo "<br>login_model is called";
class LoginModel {
	public static function getlogin()
 	{		
		if(isset($_POST['register'])){
			return 'register';
		}
		
		if(isset($_POST['submit'])){
	
			if(isset($_POST['userid']) && isset($_POST['password'])){
				// for easy log in for testing 
				if($_POST['userid']=='login' && $_POST['password']=='login'){
					return 'login';
				}
			
				// for easy admin log in for testing 
				if($_POST['userid']=='admin' && $_POST['password']=='admin'){
					return 'admin';
				}

				// extract variables
				// $sid = mysql_real_escape_string($_POST['userid']);
				// $password = password_hash(mysql_real_escape_string($_POST['password']), PASSWORD_DEFAULT); // hash the password
				$sid = (string)$_POST['userid'];
				$password = (string)$_POST['password'];
				// $password = mysql_real_escape_string($_POST['password']);
				// $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

				// echo "<br>userid  is ".$sid;
				// echo "<br>password is ".$password;

				// connect to database 	
				require_once 'model/dbConnect.php'; 
				global $conn;
				$conn  = connect_to_db('crs');	
				
				// check database
			
				$login_query = "SELECT user_id, admin from User where user_id = ? and password = ? ";

				$login_stmt = mysqli_prepare($conn, $login_query);
				
				mysqli_stmt_bind_param($login_stmt, 'ss', $sid, $password);

				mysqli_stmt_execute($login_stmt);

				mysqli_stmt_bind_result($login_stmt, $userid, $admin);
				mysqli_stmt_fetch($login_stmt);

				mysqli_stmt_close($login_stmt);

				if( !$userid){
					// echo "<br> invalid user";
					return 'invalid user';

				}else{
					// echo "admin is $admim";
					// echo "userid is $userid";
					// echo "Welcome! ";

					$_SESSION['userid'] = $userid;
					if (!$admin){					
						return "login";
					}else{
						return "admin";
					}
				}

		}
 	}
 
}
}
?>
