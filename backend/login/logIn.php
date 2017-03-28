<?php
require_once '../core.inc.php';
/*
Path: /login/login.php

Description: log in function

Input:
	$_POST
		'Email'		(string) Email
		'Password'	(string) Password

Output
	1						login
		
Error:
	0						Invalid Email/Password combination
	-1
	-7						required field not set
*/

if (!$con) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

if (isset($_POST['Email']) && isset($_POST['Password'])) {
	global $con;
	$Email = $_POST['Email'];
	$Password = $_POST['Password'];
	$Password_hash = md5($Password);

	if (!empty($Email) && !empty($Password)) {
		$sql = "SELECT PersonId FROM Person WHERE Email='$Email' AND Password = '$Password_hash'";

		$result = $con->query($sql);

		if ($result->num_rows > 0) {
			$PersonId = $result->fetch_assoc()['PersonId'];
			$_SESSION['PersonId'] = $PersonId;
			
			$sql2 = "SELECT PersonId FROM Retailers WHERE PersonId='$PersonId'";
			$result2 = $con->query($sql2);

			if ($result2->num_rows > 0) {
				$_SESSION['UserType'] = '1';
				echo "11";
			}else {
				$_SESSION['UserType'] = '0';
				echo "10";
			}
		} else {
			echo "0";
		}
	}
} else {
	echo '-7';
} 

?>
