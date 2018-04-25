<?php
    require 'dbConnect.php';
    // $conn = connect_to_db('crs');
    session_start(); 
class RegisterModel {

	public static function register()
 	{
        if(isset($_POST['submit'])){
            //validation 
            
            $fname=trim($_POST["firstname"]);
            $lname=trim($_POST["lastname"]);
            $userid=trim($_POST['user_id']);
            $email=trim($_POST["email"]);
            $phone=trim($_POST["phone"]);
            $password=trim($_POST["password"]);
            $cpassword=trim($_POST["cpassword"]);
            $admin_key=trim($_POST["key"]);
            $validated = true;
            if (!preg_match("/^[a-zA-Z]*$/",$fname)){
                $validated = false;
                echo "<br> Invalid First Name";
            }else{
                echo "<script>$('#firstname').addClass('was-validated')</script>";
            }
            if (!preg_match("/^[a-zA-Z]*$/",$lname)){
                $validated = false;
                echo "<br> Invalid Last Name";
            }else{
                echo "<script>$('#lastname').addClass('was-validated')</script>";
            }
            if (!preg_match("/^[0-9]{8}/",$userid)){
                $validated = false;
                echo "<br> Invalid User Id ";
            }else{
                 // check whether the id has already created an account
                $check_whether_created_query = "SELECT user_id from User where user_id =?";
                $check_whether_created_stmt = mysqli_prepare($conn, $check_whether_created_query);
                
                mysqli_stmt_bind_param($check_whether_created_stmt,"s", $userid);
                $check_whether_created_stmt->execute();
                if( $check_whether_created_stmt->fetch()){
                    echo "<br> The Userid has already registered";
                    $validated = false;
                }else{                  
                    echo "<script>$('#userid').addClass('was-validated')</script>";                    
                }
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $validated = false;
                echo "<br> Invalid Email";
            }else{
                echo "<script>$('#email').addClass('was-validated')</script>";
            }
            if(!preg_match("/^[0-9]{3}[0-9]{3}[0-9]{4}$/", $phone)) {
                $validated = false;
                echo "<br> Invalid Phone";
            }else{
                echo "<script>$('#phone').addClass('was-validated')</script>";
            }
            if (!preg_match("/^[0-9][a-zA-Z ]*$/",$password)){
                $validated = false;
                echo "<br> Invalid Password";
            }else{
                echo "<script>$('#password').addClass('was-validated')</script>";
            }
            if ($password != $cpassword){
                $validated = false;
                echo "<br> Please confirm your password";
            }else{
                echo "<script>$('#cpassword').addClass('was-validated')</script>";
            }
            if (!$adminkey ){
                echo "<br> Not a admin register";
                $admin = false;
                echo "<script>$('#cpassword').addClass('was-validated')</script>";
            }
            else if ($adminkey == "secretkey"){
                $admin = true;
                echo "<script>$('#cpassword').addClass('was-validated')</script>";
            }else{
                $validated = false;
                echo "<br> Wrong Admin Key";
            }
            if ($validated){
                $fname=trim($_POST["firstname"]);
                $lname=trim($_POST["lastname"]);
                $userid=trim($_POST['user_id']);
                $email=trim($_POST["email"]);
                $phone=trim($_POST["phone"]);
                $password=trim($_POST["password"]);
                $cpassword=trim($_POST["cpassword"]);
                $admin;
    
                if ($admin){
                    // query for admin 
                    $insert_query = "INSERT INTO User (fname,lname, user_id, email, phone, password, admin) VALUES(?,?,?,?,?,?,true)";
                }else{
                    //query for regular user
                    $insert_query = "INSERT INTO User (fname,lname, user_id, email, phone, password, admin) VALUES(?,?,?,?,?,?,false)";
                }
                $insert_user = mysqli_prepare($conn,$insert_query);
                mysqli_stmt_bind_param($insert_user,"ssssss", $fname, $lname, $user_id, $email, $phone, password_hash($password, PASSWORD_DEFAULT); // hash the password
                $insert_user->execute();
                $inserted_id = mysqli_stmt_insert_id($selectCustomer);
                mysqli_stmt_close($insert_user);
                disconnect_from_db($conn, $insert_user);

                return "success";

            }else{
                return "failed";
            }
        }
        
           
    }
		
}
 
?> 
