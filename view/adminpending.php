<?php 

session_start(); 
//print_r($_SESSION);

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

	//finds all pending reservations
	function hasRoomPending ($con) {

		$getRoom = $con->prepare("SELECT R.roomname, R.room_id, O.room_id, U.user_id, O.start_time, O.end_time FROM Room R, Reservation O, User U WHERE R.room_id=O.room_id AND O.user_id=U.user_id AND O.approved IS NULL");
		$getRoom->execute();
		$rooms = $getRoom->fetchAll();

		return $rooms;
	 
	}

	$rooms = hasRoomPending($con);

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		foreach($rooms as $array){
			$thisRoomId = $array["room_id"];
			if(isset($_POST["accept".$thisRoomId])){
				$query = "UPDATE Reservation SET approved=TRUE WHERE room_id=?";
				if($acceptRoom = $con->prepare($query)){
					$acceptRoom->execute(array($thisRoomId));
				}
			}
			if(isset($_POST["deny".$thisRoomId])){
		  		$denyRoom = $con->prepare("UPDATE Reservation SET approved=FALSE WHERE room_id=?");
				$denyRoom->execute(array($thisRoomId));
	  		}
		}
		$rooms = hasRoomPending($con);
	}
	

?>

	<head> 
		<Title> Admin Pending Page</Title>
    	<meta name="description" content="Page where admin can see all pending reservations.">
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
		      <li><a href="adminview.php">All Reservations</a></li>
		      <li class="active"><a href="adminpending.php">Pending Reservations</a></li>
		      <li><a href="AdminUpdateRoomFeaturesv2.php">Room Updates</a></li>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Log out </a></li>
		    </ul>
		  </div>
		</nav>
	</header>

	<body>
		<h2>Current Reservations </h2>
		<form method="post">
		<table width = 80%, class="table table-striped">
			<tr> 
				<th>Room</th>
				<th>Date and Time</th>
				<th>User</th>
				<th>Action</th>
			</tr>
			<?php
				foreach ($rooms as $array) {
					$thisRoomId = $array["room_id"];
					$thisRoomName = $array["roomname"];
					$thisRoomStart = $array["start_time"];
					$thisRoomEnd = $array["end_time"];
					$thisRoomUser = $array["user_id"];

					echo "<tr><td>".$thisRoomName."</td>"; //room name
					echo "<td>".date("jS \of F, Y h:ia", strtotime($thisRoomStart))." to ".date("jS \of F, Y h:ia", strtotime($thisRoomEnd))."</td>"; //time of reservation
					echo "<td>".$thisRoomUser."</td>"; //room user
					echo "<td><input type='submit' name='accept".$thisRoomId."'value='Accept' />  <input type='submit' name='deny".$thisRoomId."'value='Deny'/></td>";
					echo "</tr>";
				}
			
			?>
		</table>
	</form>
	</body>
