<?php

// initialize return variable (will be encoded as JSON)
$data = '';

// attempt to connect to database
$con = mysqli_connect("localhost", "root", "mysql", "magicc_hat");
if (mysqli_connect_errno($con)) { die(print($data)); }

// get entire database
if ($_REQUEST['method'] == 'GET' && $_REQUEST['isArray'])
{
	$sql = mysqli_query($con,"SELECT * FROM people");
	
	// return results encoded in JSON format
	$result = array();
	while ($rlt = mysqli_fetch_assoc($sql)) {
		$result[] = $rlt;
	}
	$data = json_encode($result);
}

else if ($_REQUEST['method'] == 'GET' && !$_REQUEST['isArray'])
{
	$personID = $_REQUEST['personID'];
	$sql = mysqli_query($con, "SELECT * FROM people WHERE personID = $personID");
	$data = json_encode(mysqli_fetch_assoc($sql));
}

else
{
	$data = json_encode();
}

// return data
print($data);

?>