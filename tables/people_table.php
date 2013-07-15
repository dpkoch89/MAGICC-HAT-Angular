<?php

// attempt to connect to database
//$con = connectToDB();
$con = mysqli_connect("localhost", "root", "mysql", "magicc_hat");
if (mysqli_connect_errno($con)) { echo "Connection Error: " . mysqli_connect_err($con); }

// Query for people
//$result = mysqli_query($con,"SELECT PersonID, FirstName, LastName FROM people");
$result = mysqli_query($con,"SELECT * FROM people");

// return results encoded in JSON format
$rows = array();
while ($r = mysqli_fetch_assoc($result)) {
	$rows[] = $r;
}
print json_encode($rows);

// close connection
mysqli_close($con);
?>