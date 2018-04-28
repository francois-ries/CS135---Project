<?php
session_start(); 
class RegisterModel {
    public static function validation(){
        //validation 
        // $validated = true;
        $fname=trim($_POST["firstname"]);
        $lname=trim($_POST["lastname"]);
        $userid=trim($_POST['userid']);
        $email=trim($_POST["email"]);
        $phone=trim($_POST["phone"]);
        $password=trim($_POST["password"]);
        $cpassword=trim($_POST["cpassword"]);
        $adminkey=trim($_POST["key"]);
        
        if (!preg_match("/^[a-zA-Z]*$/",$fname)){  
            // $validated = false;
            echo "<br> Invalid First Name";
            return 3;
        }else{
            echo "<script>$('#firstname').addClass('was-validated')</script>";
        }
        if (!preg_match("/^[a-zA-Z]*$/",$lname)){
            // $validated = false;
            echo "<br> Invalid Last Name";
            return 3;
        }else{
            echo "<script>$('#lastname').addClass('was-validated')</script>";
        }
        
        if (!preg_match("/^[0-9]{8}/",$userid)){
            echo "<br> $userid";
            // $validated = false;
            echo "<br> Invalid User Id ";
            return 3;
        }else{
             // check whether the id has already created an account
            require_once 'model/dbConnect.php';
            $conn = connect_to_db('crs');
            $check_whether_created_query = "SELECT user_id from User where user_id =?";
            $check_whether_created_stmt = mysqli_prepare($conn, $check_whether_created_query);
            
            mysqli_stmt_bind_param($check_whether_created_stmt,"s", $userid);
            mysqli_stmt_execute($check_whether_created_stmt);
            mysqli_stmt_bind_result($check_whether_created_stmt, $userid);
            mysqli_stmt_fetch($check_whether_created_stmt);
            mysqli_stmt_close($check_whether_created_stmt);
            
            // if( mysqli_stmt_fetch($check_whether_created_stmt->fetch()){
            if ($userid){
                echo "<br> The Userid has already registered";
                return 2;
                // return "false";
                // $validated = false;
            }else{                  
                echo "<script>$('#userid').addClass('was-validated')</script>";                    
            }
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            // $validated = false;
            echo "<br> Invalid Email";
            return 3;
        }else{
            echo "<script>$('#email').addClass('was-validated')</script>";
        }
        if(!preg_match("/^[0-9]{3}[0-9]{3}[0-9]{4}$/", $phone)) {
            // $validated = false;
            echo "<br> Invalid Phone";
            return 3;
        }else{
            echo "<script>$('#phone').addClass('was-validated')</script>";
        }
        
        /*
        if (!preg_match("/^[0-9][a-zA-Z ]*$/",$password)){
            $validated = false;
            echo "<br> Invalid Password";
        }else{
            echo "<script>$('#password').addClass('was-validated')</script>";
        }
        */
    
        if ($password != $cpassword){
            //$validated = false;
            echo "<br> Please confirm your password";
            return 3;
        }else{
            echo "<script>$('#cpassword').addClass('was-validated')</script>";
    
        }
    
        if (!$adminkey ){
            echo "<br> Not a admin register";
            $admin = false;
            echo "<script>$('#cpassword').addClass('was-validated')</script>";
            $_POST["admin"] = 0;  
        }
        else if ($adminkey == "secretkey"){
            $admin = true;
            echo "<script>$('#cpassword').addClass('was-validated')</script>";
            $_POST["admin"] = 1;  
        }else{
            //$validated = false;
            return 3;
            echo "<br> Wrong Admin Key";
        }
    
        return 1;
    
    }
    
    public static function insert_user (){
        $fname=trim($_POST["firstname"]);
        $lname=trim($_POST["lastname"]);
        $userid=trim($_POST['userid']);
        $email=trim($_POST["email"]);
        $phone=trim($_POST["phone"]);
        $password=trim($_POST["password"]);
        $admin=$_POST["admin"];
        echo "<br>admin is ".$admin;
        echo "<br>fname : ".$fname;
        echo "<br>lname : ".$lname;
        echo "<br>userid : ".$userid;
        echo "<br>email : ".$email;
        echo "<br>phone : ".$phone;
        echo "<br>password : ".$password;
    
        if ($admin == 1){
            // query for admin 
            $insert_query = "INSERT INTO User (fname, lname, user_id, email, phone, password, admin) VALUES(?,?,?,?,?,?, TRUE)";
        }else if ( $admin == 0){
            //query for regular user
            $insert_query = "INSERT INTO User (fname, lname, user_id, email, phone, password, admin) VALUES(?,?,?,?,?,?, FALSE)";
        }else{
            echo "error";
        }
    
        echo " <br> $insert_query";
    
        require_once('model/dbConnect.php');
        global $conn;
        $conn = connect_to_db('crs');
    
        $insert_user = mysqli_prepare($conn, $insert_query);
    
        // mysqli_stmt_bind_param($insert_user,"ssssss", $fname, $lname, $user_id, $email, $phone, password_hash($password, PASSWORD_DEFAULT)); // hash the password
        mysqli_stmt_bind_param($insert_user,"ssssss", $fname, $lname, $userid, $email, $phone, $password); 
        // $insert_user->execute();
        
        mysqli_stmt_execute($insert_user);
    
        // $inserted_id = mysqli_stmt_insert_id($insert_user);
    
        $query = "SELECT user_id from User where user_id =?";
    
        $stmt = mysqli_prepare($conn, $query);
        
        mysqli_stmt_bind_param($stmt,"s", $userid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $_userid);
        mysqli_stmt_fetch($stmt);
    
        echo "<br> inserted id is :". $_userid ;
        //echo "<br> inserted id is : $inserted_id ";
    
        mysqli_stmt_close($insert_user);
    
        // disconnect_from_db($conn, $insert_user);
        echo "<br> register success";
        return "true";
    }
    


    public static function get_register(){
        echo " entered get register";
        echo "<br> called get_register ";
        if(isset($_POST['register_submit'])){
            echo "<br> called register submit function";
            
        //if(isset($_POST['register_submit'])){
            $validated = RegisterModel::validation();
            echo "<br> called validation function";
            if ($validated == 1){
                $db_insert = RegisterModel::insert_user(); 
                if ($db_insert== true){
                    echo "success registered ";
                    return 'success';
                }else{
                    echo "failed registered ";
                    return'failed';
                }
            }
            else if ($validated == 2){
                echo "validation did not pass";
                return "user existed";
            } else{
                echo "validation did not pass";
               return "failed";
            }
        }
    }
        		
}
 
?> 
