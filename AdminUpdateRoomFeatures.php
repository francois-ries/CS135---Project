<?php 
session_start(); 
//print_r($_SESSION);
//require 'dbConnect.php';
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


?>

<!DOCTYPE html>

<?php 
	if (isset($_SESSION['userid'])) {
		$sid = $_SESSION['userid'];
 	}
?>

<!-- PHP CODE -->
<?php

$roomName = null;
if(isset($_POST["RoomName"])) {
    $roomName = trim($_POST["RoomName"]);
}

$roomID = null;
if(isset($_POST["RoomID"])) {
    $roomID = trim($_POST["RoomID"]);
}

$isWhiteboardSet = 0;
if(isset($_POST["whiteboard"])) {
  $isWhiteboardSet = 1;
}

$isComputerSet = 0;
if(isset($_POST["computer"])) {
  $isComputerSet = 1;
}

$roomInfo_array = array();
//getRoomInfo($con, $roomInfo_array, $roomName);

if (isInDB($con, $roomName)) {
  getRoomInfo($con, $roomInfo_array, $roomName);
}

function isInDB($con, $roomName) {
    //SELECT `room_id` WHERE `room_name`="test"
    if ($roomName != null) {
      $getRoom = $con->prepare("SELECT room_id FROM room WHERE room_name = ?");
      $getRoom->execute([$roomName]);
      $results = $getRoom->fetch();

      if (!$results) {
        //echo "NULL";
        return false;
      } else {
        //echo "NOT NULL";
        return true;
      }
    }
}

// Returns an array with all the info of a given room name 
//  Need to fix: check if the rooms exist before sending the SQL query
function getRoomInfo($con, $roomInfo_array, $roomName) {

  if ($roomName != null ) {
    $getInfo = $con->prepare("SELECT room_id, room_name, capacity, location, computer, blackboard FROM room WHERE room_name = ?");
    $getInfo->execute([$roomName]);
    $results = $getInfo->fetchall();

    foreach ($results as $array) {
      $thisRoomID = $array["room_id"];
      $thisRoomName = $array["room_name"];
      $thisCapacity = $array["capacity"];
      $thisLocation = $array["location"];
      $thisComputer = $array["computer"];
      $thisBlackboard = $array["blackboard"];
  }
  global $roomInfo_array;
  $roomInfo_array["room_id"] = $thisRoomID; 
  $roomInfo_array["room_name"] = $thisRoomName; 
  $roomInfo_array["capacity"] = $thisCapacity;
  $roomInfo_array["location"] = $thisLocation;
  $roomInfo_array["computer"] = $thisComputer;
  $roomInfo_array["blackboard"] = $thisBlackboard;

  print_r($roomInfo_array);
}
}


?>

<script>

// Extracts the information about the the searched room
var hasComputer = "<?php echo $roomInfo_array["computer"] ?>";
var hasBlackboard = "<?php echo $roomInfo_array["blackboard"] ?>";
var capacity = "<?php echo $roomInfo_array["capacity"] ?>";
console.log(hasComputer);
console.log(hasBlackboard);
console.log(capacity);




</script>

	<head> 
		<Title> Admin Main Page</Title>
    	<meta name="description" content="Main admin page where admin can view all current reservations.">
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>src="AdminUpdateRoomjQuerry.js"</script>

	</head>

	<header>
		<!---creates a navigator which links to main page or reservation page-->
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" href="#">CMC Room Reservations</a>
		    </div>
		    <ul class="nav navbar-nav">
              <li><a href="userview.php">Current Reservations</a></li>
              <li class="active"><a href="AdminUpdateRoomFeatures.php">Update Room Features</a></li>
		      <li><a href="UserBooking.php">Make A Reservation</a></li>
            </ul>
		    <ul class="nav navbar-nav navbar-right">
		      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Log out </a></li>
		    </ul>
		  </div>
		</nav>
    </header>
    

<h2>Update Room Features</h2>

<center>
<form method="post" class="form-inline">
  <div class="form-group">
    <label for="RoomName">Room Name:</label>
    <input name="RoomName" class="form-control" id="RoomName">
  </div>
  <!-- <button type="submit" class="btn btn-default">Search</button> -->
  <input type="submit" class="btn btn-default">
</form>
</center>

<center><p><i> Please enter the Room Name</i></p></center>
<center><p> <?PHP if (!isInDB($con, $roomName)) {echo "This room doesn't exist";} ?> </p><center>

<center>
<div class="panel panel-primary">
  <div class="panel-heading">Room Selected</div>
  <div class="panel-body"><?php if(isset($roomInfo_array["room_name"])) {
    echo $roomInfo_array["room_name"];
  } ?></div>
</div>
</center>

<h3>Room Features: </h3>

<form method="post" class="form-inline">


<input hidden name="RoomName" value ="<?php if(isset($roomInfo_array["room_name"])) {echo $roomInfo_array["room_name"];} ?>"> </input>

<table>
	<tbody>
		<tr>
			<td> Whiteboard </td>
			<td>
      <label class="switch">
      <input name="whiteboard" id="whiteboard" <?php if (isset($roomInfo_array["blackboard"])) {if ($roomInfo_array["blackboard"] == 1) echo "checked"; else echo "unchecked";}?> type="checkbox">
       <span class="slider round"></span>
      </label> 
    </td>
		</tr>
		<tr>
			<td>Computer</td>
			<td>
      <label class="switch">
      <input name="computer" id="computer" <?php if (isset($roomInfo_array["computer"])) {if ($roomInfo_array["computer"] == 1) echo "checked"; else echo "unchecked";} ?> type="checkbox">
       <span class="slider round"></span>
      </label> 
      </td>
		</tr>
	</tbody>
</table>


<center>
<div class="form-group">
    <label for="RoomName">Room Capacity:</label>
    <input name="RoomCapacity" class="form-control" id="RoomCapacity" value="<?php if(isset($roomInfo_array["capacity"])) {
      echo $roomInfo_array["capacity"]; 
    } ?>">
</div>
 </center>

<input type="submit" class="btn btn-default">
<form>


<!-- PHP CODE PART II -->
<?php


$isComputer = 0;
if(isset($_POST["computer"])) {
  $isComputer = 1;
}
$isWhiteboard = 0;
if(isset($_POST["whiteboard"])) {
  $isWhiteboard = 1;
}
$isCapacity = 0;
if(isset($_POST["RoomCapacity"])) {
  $isCapacity = $_POST["RoomCapacity"];
}

if (!isset($roomName)) {
  global $roomName;
  if(isset($roomInfo_array["room_name"])){
   $roomName = $roomInfo_array["room_name"];
  }
}


if (isset($_POST["RoomCapacity"])) {
  updateCapacity($con, $roomName, $roomInfo_array["capacity"], $isCapacity);
}

function updateCapacity ($con, $roomName, $oldCapacity, $newCapacity) {
  //UPDATE room SET `capacity`= 40 WHERE room_name="BC23"

  if ($newCapacity <= 0) {
    echo "The capacity canot be zero or negative";
  } else {
    if ($oldCapacity != $newCapacity) {
      $updateRoom = $con->prepare("UPDATE room SET capacity = ? WHERE room_name = ?");
      $updateRoom->execute([$newCapacity, $roomName]);
      echo "Room Capacity was updated </br>";
    }
  }
}

if (isset($_POST["RoomCapacity"])) {
  updateComputer($con, $roomName, $roomInfo_array["computer"], $isComputer);
}


function updateComputer ($con, $roomName, $oldComputer, $newComputer) {
  if ($newComputer != $oldComputer) {
    $updateRoom = $con->prepare("UPDATE room SET computer = ? WHERE room_name = ?");
    $updateRoom->execute([$newComputer, $roomName]);
    echo "Room Computer was updated </br>";
  }
}

if (isset($_POST["RoomCapacity"])) {
  updateWhiteboard($con, $roomName, $roomInfo_array["blackboard"], $isWhiteboard);
}


function updateWhiteboard($con, $roomName, $oldWhiteboard, $newWhiteboard) {
   if($oldWhiteboard != $newWhiteboard) {
     $updateRoom = $con->prepare("UPDATE room SET blackboard = ? WHERE room_name = ?");
     $updateRoom->execute([$newWhiteboard, $roomName]);
     echo "Room Whiteboard was updated </br>";
   }
}



?>

<!-- CSS -->
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

<html>
