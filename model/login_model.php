<?php
// connect to database 
// require 'dbConnect.php';
// $conn = connect_to_db('crs');
session_start(); 
echo "<br>login_model is called";
class LoginModel {
	public static function getlogin()
 	{
		// return "cool" ;
		// here goes some hardcoded values to simulate the database
		echo "<br>login_model get log in  function is called";
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
			$sid = mysql_real_escape_string($_POST['userid']);
			$password = password_hash(mysql_real_escape_string($_POST['password']), PASSWORD_DEFAULT); // hash the password
			// check database
			$login_query = "SELECT user_id, admin from User where user_id =? and password = ?";
			$login_stmt = mysqli_prepare($conn, $login_query);
			
			mysqli_stmt_bind_param($login_stmt,"ss", $sid, $password);
			$login_stmt->execute();
			$result = $login_stmt->fetch(PDO::FETCH_ASSOC);
			if(!$result){
				return 'invalid user';
			}else{
				$row = mysql_fetch_assoc($result);
				$userid = $row['user_id'];
				echo "Welcome! ";
				$_SESSION['userid'] = $userid;
				$admin = $row['admin'];
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
