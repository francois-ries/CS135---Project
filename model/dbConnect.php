<?php
function connect_to_db( $dbname ){
	
	// Usage: host, login, pass, db name
	// Change the host, login, and db information as appropriate 
	$dbc = mysqli_connect( "localhost", "root", "root", $dbname ) or
			die( "Connect failed: ". mysqli_connect_error() );
	if ($dbc->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else{
		echo " connection is cool<br>";
	}
		
	return $dbc;
}
function disconnect_from_db( $dbc, $result ){
	mysqli_free_result( $result );
	mysqli_close( $dbc );
}
function perform_query( $dbc, $query ){
	
	$result = mysqli_query($dbc, $query) or 
			  die( "bad query".mysqli_error( $dbc ) );
			  
	return $result;
}
?>