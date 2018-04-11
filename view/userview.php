<?php 

session_start(); 
print_r($_SESSION);

?>

<!DOCTYPE html>

<?php 
	if (isset($_SESSION['userid'])) {
		$sid = $_SESSION['userid'];
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

	//finds all pending and accepted reservations with user with userid $sid
	function hasRoom ($con, $sid) {

		$getRoom = $con->prepare("SELECT R.roomname, R.rid, O.rid, U.sid, O.start_time, O.end_time, R.computer, R.blackboard FROM R.Room, O.Reservation, U.User WHERE R.rid=O.rid AND R.sid=U.sid AND U.sid=?");
		$getRoom->execute($sid);
		$rooms = $getRoom->fetchAll();

		return $rooms;
	 
	  }
	  $rooms = hasRoom($con, $sid);

?>

	<head> 
		<Title> User Main Page</Title>
    	<meta name="description" content="Main user page where current reservations are displayed.">
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
		      <li class="active"><a href="userview.php">Current Reservations</a></li>
		      <li><a href="UserBooking.php">Search</a></li>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Log out </a></li>
		    </ul>
		  </div>
		</nav>
		<h1> Welcome <?php echo $username; ?> </h1>
	</header>

	<body>
		<h2>Reservations </h2>
		<table width = 80%, class="table table-striped">
			<tr> 
				<th>Room</th>
				<th>Date</th>
				<th>Time</th>
				<th>Room Features</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
			<?php 
				foreach ($rooms as $array) {
					$thisRoomId = $array["room_id"];
					$thisRoomName = $array["roomname"];
					$thisRoomStart = $arry["start_time"];
					$thisRoomEnd = $array["end_time"];
					$thisRoomComputer = $array["computer"];
					$thisRoomBlackboard = $array["blackboard"];
					$thisRoomApproved = $array["approved"];
					$status = "";
					if($thisRoomApproved == true){
						$status = "Accepted";
					}else{
						$status = "Pending";
					}
					echo "<tr><td>".$thisRoomName."</td>"; //room name
					echo "<td>Add date here </td>"; //date of reservation
					echo "<td>".$thisRoomStart."to".$thisRoomEnd."</td>"; //time of reservation
					echo "<td> Computer: ".$thisRoomComputer." Blackboard: ".$thisRoomBlackboard."</td>"; //room features
					echo "<td>".$status."</td>"; //status of resrervation
					echo "<td><input type='submit' name='cancel".$thisRoomId."value='Cancel'/></td>"; //cancel reservation
					echo "</tr>";
				}
			?>
		</table>
</body>

