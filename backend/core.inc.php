<?php
ob_start();
session_start();

$mysql_host = 'localhost';
$mysql_Person = 'root';
$mysql_pass = '';
$mysql_db = 'CS304';

$connect_error = "fail to login";
$current_file = $_SERVER['SCRIPT_NAME'];
//$http_referer = $_SERVER['HTTP_REFERER'];

//$con = mysqli_connect($mysql_host, $mysql_Person, $mysql_pass, $mysql_db);
$con = new mysqli($mysql_host, $mysql_Person, $mysql_pass, $mysql_db);

function loggedin() {
	if (isset($_SESSION['PersonId']) && !empty($_SESSION['PersonId'])) {
		return true;
	} else {
		return false;
	}
}

function getPersonName($c, $i) {
	$query = "SELECT FirstName FROM Person WHERE PersonId = '$i'";
	$r = mysqli_fetch_array(mysqli_query($c, $query));
	return $r['FirstName'];
}
?>