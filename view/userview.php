<?php 

session_start(); 
print_r($_SESSION);
//require 'dbConnect.php';
/*define('DBHOST',"localhost"); //will change variables later
define('DBNAME', "gsc");
define('DBUSER',"klaudia");
define('DBPASS',"dziewulski");

$connection = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if ($connection->connect_error) {
	$output = "<p>Unable to connect to database -- </p>" . $connection->connect_error;
	exit($output);
} else {
	$output = "<p>Connected to database </p>";
}
echo $output;*/
?>

<!DOCTYPE html>

<?php 
	if (!isset($_SESSION['userid'])) {
	    $_SESSION['userid'] = new ShoppingCart();
	}
	$sid = $_SESSION['userid'];

	$query = "SELECT fname from Customer where sid=?"; //select name from table if it matches input that was given
	if($selectUser = $connection -> prepare($query)){ //makes sure prepare is not false
		$selectUser -> bind_param("i", $sid);
	}
	if(!$selectUser) die ("Database access failed: " . $connection->error);
	mysqli_stmt_execute($selectUser);
    $selectUser -> bind_result($sid);
    if($selectUser -> fetch()){ //means user is already in database, prints user name if already in db
    	echo "Your name is $username <br>"; 
    }else{
    	echo "User not found <br>";
    }
    mysqli_stmt_close($selectUser);
?>

<head> 
		<Title> User Main Page</Title>
    	<meta name="description" content="Main user page where current reservations are displayed.">
    	<style>
    		.nav{
    			display: inline;
    			padding: 8px;
    			background-color: darkcyan;
    		}
    	</style>
	</head>

	<header>
		<!---creates a navigator which links to main page or reservation page-->
		<ul style="list-style-type: none; margin:0; padding:0">
			<li class="nav"><a href="userview.php">Main</a></li>
			<li class="nav"><a href="UserBooking.php">Search</a></li> <!--will link to search page-->
		</ul>
		<h1> Welcome <?php echo $username; ?> </h1>
	</header>

	<body>
		<h2>Reservations </h2>
		<table width = 80%>
			<tr> 
				<th>Room</th>
				<th>Date</th>
				<th>Time</th>
				<th>Room Features</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
			<?php
			foreach($this->order as $key => $value){//iterate through reservations
		          echo "<tr><td>".$roomname."</td>"; //room name
		          echo "<td>".ShoppingCart::$cookieTypes[$key]."</td>"; //date of reservation
		          echo "<td>".$start_time."to".$end_time."</td>"; //time of reservation
		          echo "<td> $".$computer.$blackboard"</td>"; //room features
		          echo "<td>".$approved."</td>"; //status of resrervation
		          echo "<td><input type='submit' name='cancel".$room_id."value='Cancel'/></td>"; //cancel reservation
		          echo "</tr>";
		      }
			?>
		</table>
