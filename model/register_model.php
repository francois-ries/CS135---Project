<?php



class Model {

	public function register()
 	{
		// return "cool" ;
        // here goes some hardcoded values to simulate the database
        if(isset($_POST['submit'])){
            /// enter the info into database 
           
        }

  		
 	}
 
}

?> 

<?php 
// Include the ShoppingCart class.  Since the session contains a
// ShoppingCard object, this must be done before session_start().
    require "../application/cart.php";
    require 'dbConnect.php';
    $conn = connect_to_db('gsc');
    require 'queries.php';
    require 'handle_order.php';
    session_start(); 
?>

<?php 
    // If this session is just beginning, store an empty ShoppingCart in it.
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = new ShoppingCart();
    }

    $cart = $_SESSION['cart']->get_cart();

    // get total 
    $total_quatity = $_SESSION['cart']->get_total_quantity();
    $total_price = $_SESSION['cart']->get_total_price();
?>

<?php
if(isset($_POST['submit'])){

    $fname=trim($_POST["firstname"]);
    $lname=trim($_POST["lastname"]);
    $gsname=trim($_POST['gsname']);
    $gstroop=trim($_POST["gstroop"]);
    $email=trim($_POST["email"]);
    $phone=trim($_POST["phone"]);
    $zip=trim($_POST["zip"]);

    $validated = true;

    if (!preg_match("/^[a-zA-Z ]*$/",$fname)){
        $validated = false;
        echo "<br> Invalid First Name";
    }else{
        echo "<script>$('#firstname').addClass('was-validated')</script>";
    }

    if (!preg_match("/^[a-zA-Z ]*$/",$lname)){
        $validated = false;
        echo "<br> Invalid Last Name";
    }else{
        echo "<script>$('#lastname').addClass('was-validated')</script>";
    }
    if (!preg_match("/^[a-zA-Z ]*$/",$gsname)){
        $validated = false;
        echo "<br> Invalid Girl Scout Name";
    }else{
        echo "<script>$('#gsname').addClass('was-validated')</script>";
    }
    if (!preg_match("/^[a-zA-Z ]*$/",$gstroop)){
        $validated = false;
        echo "<br> Invalid Girl Scout Troop";
    }else{
        echo "<script>$('#gstroop').addClass('was-validated')</script>";
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

    if(!preg_match("/^\[0-9]{5}$/", $zipcode)){
        //$validated = false;
        echo "<br> Invalid Zipcode";
    }else{
        echo "<script>$('#zip').addClass('was-validated')</script>";
    }

    if ( $validated == true ){
        echo "all passes"."<br>";
            $name = $fname." ".$lname;
            $gsname=trim($_POST['gsname']);
            $gstroop=trim($_POST["gstroop"]);
            $email=trim($_POST["email"]);
            $phone=trim($_POST["phone"]);
            $zipcode=trim($_POST["zip"]);
            $city=trim($_POST["city"]);
            $state=trim($_POST["state"]);
            $address = trim($_POST["address"]);
            $address2 = trim($_POST["address2"]);
            $street_address = $address+"@"+$address2;
            // echo " got all variables, ready to do some sql "."<br>";


            // see whether the customer is in the database
            $selectCustomer->execute();
            $selectCustomer->bind_result($cid);
            if($selectCustomer->fetch()){
                //echo " fetched the customer "."<br>";
                $cid = $cid;      
                //echo "Your ID is ".$cid. ". <br>";
            }else{
                echo "start to create a customer"."<br>";
                // not in database, then create a new customer row 
                mysqli_stmt_execute($insertCustomer);
                // echo "executed one insert customer <br>";
                //fetch cid and bind it 
                $cid = mysqli_insert_id($conn);
                echo "Welcome, your new ID is".$cid.". <br>";
            }
            mysqli_stmt_close($selectCustomer);
            mysqli_stmt_close($insertCustomer);


            // get gsid 
            $selectGirlScout->execute();
            echo "executted slect girl s <br>";
            $selectGirlScout -> bind_result($gsid);

            if($selectGirlScout->fetch()){
                // set cid to the result 
                echo "The girls scout's ID ".$gsid. ". <br>";

            }else{
            
                // not in database, then create a new customer row 
                mysqli_stmt_execute($insertGirlScout);

                //fetch cid and bind it 
                $gsid = mysqli_stmt_insert_id($insertGirlScout);
                echo "Create a new girl in troop. Girls scout's ID".$gsid.". <br>";
            }
            $selectGirlScout->close();
            $insertGirlScout->close();


            // having both gsid and cid, then insert order row
            mysqli_stmt_execute($insert_order);
            $order_id =  mysqli_stmt_insert_id($insert_order);
            // echo "order_id is ".$order_id."<br>";
            $insert_order->close();

            //process the order 
            $box_price = 5; // all cookies are sell at 5 dollas
            foreach ($cart as $key => $value) {
                
                $type = $key;
                //echo "type ".$type."<br>";
                $quantity=$value;
                //echo "quantity ".$quantity."<br>";
                $price = $quantity*$box_price;
                //echo "price ".$price."<br>";               
                mysqli_stmt_execute($insert_cookie);
                echo "executed insert_cookie<br>";
     
            }
            $insert_cookie->close();
            echo "<script>\n
            window.location.href = 'action_page.php';\n
            </script>";
            disconnect_from_db($connection, $selectGirlScout);
        }
}
?>