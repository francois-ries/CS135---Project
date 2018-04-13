<?php 

session_start(); 
print_r($_SESSION);

?>

<!DOCTYPE html>

<?php 
	if (isset($_SESSION['userid'])) {
		$user_id = $_SESSION['userid'];
 	}

 	$servername = "localhost";
	$username = "root";
	$password = "root";

	try {
	    $con = new PDO("mysql:host=$servername;dbname=crs", $username, $password);
	    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    //echo "Connected successfully"; 
	    }
	catch(PDOException $e)
	    {
	    echo "Connection failed: " . $e->getMessage();
	    }

	//finds all accepted reservations
	function hasRoomApproved ($con) {

		$getRoom = $con->prepare("SELECT R.roomname, R.room_id, O.room_id, U.user_id, O.start_time, O.end_time FROM Room R, Reservation O, User U WHERE R.room_id=O.room_id AND O.user_id=U.user_id AND O.approved=TRUE");
		$getRoom->execute();
		$rooms = $getRoom->fetchAll();

		return $rooms;
	 
	  }
	  $rooms = hasRoomApproved($con);
?>

	<head> 
		<Title> Admin Main Page</Title>
    	<meta name="description" content="Main admin page where admin can view all current reservations.">
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	</head>

	<header>
		<!---creates a navigator which links to main page or reservation page-->
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" href="#">CMC Room Reservations</a>
		    </div>
		    <ul class="nav navbar-nav">
		      <li class="active"><a href="adminview.php">All Reservations</a></li>
		      <li class="active"><a href="adminpending.php">Pending Reservations</a></li>
		      <li class="active"><a href="adminupdates.php">Room Updates</a></li>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Log out </a></li>
		    </ul>
		  </div>
		</nav>
	</header>

	<body>
		<h2>Current Reservations </h2>
		<table width = 80%>
			<tr> 
				<th>Room</th>
				<th>Date and Time</th>
				<th>User</th>
			</tr>
			<?php
				foreach ($rooms as $array) {
					$thisRoomId = $array["room_id"];
					$thisRoomName = $array["roomname"];
					$thisRoomStart = $array["start_time"];
					$thisRoomEnd = $array["end_time"];
					$thisRoomUser = $array["user_id"];
 
					echo "<tr><td>".$thisRoomName."</td>"; //room name
					echo "<td>".$thisRoomStart." to ".$thisRoomEnd."</td>"; //time of reservation
					echo "<td>".$thisRoomUser."</td>"; //room user
					echo "</tr>";
				}
			
			?>
		</table>
	</body>
