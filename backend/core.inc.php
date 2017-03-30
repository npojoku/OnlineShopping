<?php
ob_start();
session_start();

$mysql_host = 'localhost';
$mysql_Person = 'root';
$mysql_pass = '';
$mysql_db = 'CS304';

$connect_error = "fail to login";
$current_file = $_SERVER['SCRIPT_NAME'];

$con = new mysqli($mysql_host, $mysql_Person, $mysql_pass, $mysql_db);

function isConnected() {
	global $con;
	return $con->ping();
}

function isLoggedIn() {
	if (isset($_SESSION['PersonId']) && !empty($_SESSION['PersonId'])) {
		return true;
	} else {
		return false;
	}
}

function isRetailer(){
	// verify that user type has been set
	if (isset($_SESSION['UserType']) && !empty($_SESSION['UserType'])) {

		// verify that user type is retailer
		if($_SESSION['UserType'] === '1'){
			return true;
		}
	}

	return false;
}

function getPersonName($c, $i) {
	$query = "SELECT FirstName FROM Person WHERE PersonId = '$i'";
	$r = mysqli_fetch_array(mysqli_query($c, $query));
	return $r['FirstName'];
}

// function assumes that information is already validated
// returns true if login  is successful, else false
function loginUser($Email, $Password_hash){
	global $con;

	$sql = "SELECT PersonId FROM Person WHERE Email='$Email' AND Password = '$Password_hash'";

	$result = $con->query($sql);

	// login was successful
	if ($result->num_rows > 0) {

		// store session
		$PersonId = $result->fetch_assoc()['PersonId'];
		$_SESSION['PersonId'] = $PersonId;

		// assign user type
		$sql2 = "SELECT PersonId FROM Retailers WHERE PersonId='$PersonId'";
		$result2 = $con->query($sql2);

		if ($result2->num_rows > 0) {
			$_SESSION['UserType'] = '1';
		}else {
			$_SESSION['UserType'] = '0';
		}
		return true;
	}

	return false;
}

function logoutUser(){
	session_destroy();
	$_SESSION = []; // clear session variables
}

function getPersonId(){
	return $_SESSION['PersonId'];
}
?>
