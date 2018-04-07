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

