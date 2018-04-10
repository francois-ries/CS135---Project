<!DOCTYPE html>
<!-- saved from url=(0057)https://getbootstrap.com/docs/4.0/examples/sticky-footer/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/favicon.ico">

    <title>Sticky Footer Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="./Sticky Footer Template for Bootstrap_files/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./Sticky Footer Template for Bootstrap_files/sticky-footer.css" rel="stylesheet">
    <link href="grid.css" rel="stylesheet">

    <link href="UserBookingStyle.css" rel="stylesheet">

</head>
<center><h1 text-align:"center">Make A Reservation</h1></center>
<body>

<!-- DB CONNECTION -->
<?PHP

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

<!-- FORM -->
<form method="post">

<table style="margin: 0px auto;">
  <tr>
    <th>Start Time</th>
    <th>End Time</th> 
  </tr>
  <tr> 
    <td><input name="start_time" id="start_time" type="time"></td>
    <td><input name="end_time" id="end_time" type="time"></td> 
  </tr>
</table>


<table style="margin: 0px auto;" >
		<tr>
			<td><h5>Room Equipment</h5> </td>
			<td><h5>Campus Location</h5> </td>
			<td><h5>Room Size</h5> </td>
		</tr>
		<tr>
			<td><input type="radio" id="computer" name="computer"> Computers </td>
			<td><input type="radio" id="RN" name="RN"> Rober North </td>
			<td> <input type="radio" id="under_20" name="under_20"> Under 20 </td>
		</tr>
		<tr>
			<td><input type="radio" id="blackboard" name="blackboard" > Blackboard </td>
			<td><input type="radio" id="RS" name="RS" > Robert South </td>
			<td><input type="radio" id="20-40" name="20-40"> 20-40</td>
		</tr>
		<tr>
			<td> </td>
			<td><input type="radio" id="BC" name="BC" > Bauer Center </td>
			<td> <input type="radio" id="41-60" name="41-60"> 41-60 </td>
		</tr>
		<tr>
			<td> </td>
			<td> <input type="radio" id="KS" name="KS" > Kravis Center </td>
			<td><input type="radio" id="above_60" name="above_60"> Above 60 </td>
    </tr>
</table>
<center> <input type="submit"> </center>
</form>

<!-- PHP -->
<?php

// Assigne variables
$start_time = null;
if (isset($_POST["start_time"])) {
  $start_time = trim($_POST["start_time"]);
}
$end_time = null;
if (isset($_POST["end_time"])) {
  $end_time = trim($_POST["end_time"]);
}

// Stores in array the if a specific box has been selected
$formID_array = array ("computer"=>0, "RN"=>0, "under_20"=>0, "blackboard"=>0, "RS"=>0, "20-40"=>0, "BC"=>0, "41-60"=>0, "KS"=>0, "above_60"=>0);
foreach ($formID_array as $key=>$value) {
  if (isset($_POST[$key])) {
    $formID_array[$key] = 1;
  }
}

// SQL STATEMENTS FOR THE ROOM SEARCH

$roomWithEquipement = array();
hasRoomEquipement($con, $formID_array, $roomWithEquipement);

// Should return an array with all the rooms complying with the room equipement requirements of the user
function hasRoomEquipement ($con, $formID_array, $roomWithEquipement) {
$needComputer = null;
$needBlackboard = null;

  if($formID_array["computer"] == 1) {
    $needComputer = 1; 
  } else {
    $needComputer = 0;
  }

  if($formID_array["blackboard"] == 1) {
    $needBlackboard = 1;
  } else {
    $needBlackboard = 0;
  }

  //SELECT `room_id`, `computer`, `blackboard` FROM `room` WHERE `computer`= 1 AND `blackboard`= 1
  $getRoom = $con->prepare("SELECT room_id, computer, blackboard FROM room WHERE computer = ? AND blackboard = ?");
  $getRoom->execute([$needComputer, $needBlackboard]);
  $rooms = $getRoom->fetchAll();

  // Extracts room_id, computer, and baclkboard from the room table
  foreach ($rooms as $array) {
    $thisRoomID = $array["room_id"];
    $thisComputer = $array["computer"];
    $thisBlackboard = $array["blackboard"];

    //echo "room: ".$thisRoomID." Computer: ".$thisComputer." Blackboard: ".$thisBlackboard; 
  }

  
  // Should returns an array with all the rooms complying with the campus location requirements of the user
  function hasCampusLocation ($con, $formID_array, $roomWithCampusLocation) {
    //SELECT `room_id`, `location` FROM `room`

    $getRoom = $con->prepare("SELECT room_id, location FROM room");
    $getRoom->execute();
    $rooms = $getRoom->fetchall();

    foreach ($rooms as $array) {
      $thisRoomID = $array["room_id"];
      $thisLocation = $array["location"];

      //echo "roomID: ".$thisRoomID." Location: ".$thisLocation;
    }
  }

  $roomWithCampusLocation = array();
  hasCampusLocation($con, $formID_array, $roomWithCampusLocation);

  // Should returns an array with all the rooms complying with the room size requirements of the user
  function hasCapacity ($con, $formID_array, $roomWithCapacity) {
    //SELECT `room_id`, `capacity` FROM `room`

    $getRoom = $con->prepare("SELECT room_id, capacity FROM room");
    $getRoom->execute();
    $rooms = $getRoom->fetchall();

    foreach ($rooms as $array) {
      $thisRoomID = $array["room_id"];
      $thisCapacity = $array["capacity"];

      //echo "roomID: ".$thisRoomID." Capacity: ".$thisCapacity;
    }

  }

  $roomWithCapacity = array();
  hasCapacity($con, $formID_array, $roomWithCapacity);



}

?>



<!-- DISPLAY RESULTS -->
<h2>Results</h2>
<center>
<table>
  <tr>
    <th>Room</th>
    <th>Duration</th>
    <th>Equipment</th>
    <th>Room Size</th>
    <th></th>
  </tr>
  <tr>
    <td>LC62</td>
    <td>2:00 - 3:00 PM</td>
    <td>
      <ul>
          <li>Video</li>
          <li>Computer</li>
      </ul>
    </td>
    <td>40<td>
    <td><button class="btn" type="button">Book</button></td>
  </tr>
</table>
</center>



</body></html>
