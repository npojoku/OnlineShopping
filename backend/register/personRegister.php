<?php
require '../core.inc.php';
/*
Path: /self/personRegister.php/

Description: register as a new user

Input:
	$_POST
		'FirstName'		(string) 
		'LastName'			(string) 
		'Email'				(string) 
		'Password'			(string) 
		'Phone'		(string) 
		'Address'    	(string)

Output
	1						sucessful
		
Error:
	0						failed
	-1						field must not be empty/null
	-2						Email Address/Phone number already exist
	-300					first name too long max 15
	-301					only letter and space allowed in first name
	-310					last name too long max 15
	-311					only letter and space allowed in last name
	-40						Password length must be 8 - 20
	-41						Password contains symbols (No symbol allowed)
	-42						Password must include at least one number! 
	-43						Password must include at least one lower-case letter!
	-44						Password must include at least one Upper-case letter!
	-60						Phone number length is not 10
	-61						Phone number not only contain number
	-7						required field not set
*/

global $con;
if (isset($_POST['FirstName'])&&
	isset($_POST['LastName'])&&
	isset($_POST['Email'])&&
	isset($_POST['Password'])&&
	isset($_POST['Phone'])&&
	isset($_POST['Address']) ) {
		$FirstName = $_POST['FirstName'];
		if (!preg_match("/^[a-zA-Z ]*$/",$FirstName)) {
  			echo '-301';
  			exit();
		}
		if(strlen($FirstName) > 15){
  				echo '-300';
  				exit();
  			} 

		$LastName = $_POST['LastName'];
		if (!preg_match("/^[a-zA-Z ]*$/",$LastName)) {
  			echo '-311';
  			exit();
		}
		if(strlen($LastName) > 15){
  				echo '-310';
  				exit();
  		}

		$Password = $_POST['Password'];
		if( strlen($Password) < 8 || strlen($Password) >20) {
			echo '-40';
			exit();
		}
		if( preg_match("#\W+#", $Password) ) {
			echo '-41';
			exit();
		}
		if( !preg_match("#[0-9]+#", $Password) ) {
			echo '-42';
			exit();
		}
		if( !preg_match("#[a-z]+#", $Password) ) {
			echo '-43';
			exit();
		}
		if( !preg_match("#[A-Z]+#", $Password) ) {
			echo '-44';
			exit();
		}
		$Password_hash = md5($Password); //hash the Password before saving

		$Email = $_POST['Email'];
		$Address = $_POST['Address'];

		$Phone = $_POST['Phone'];
		if(!ctype_digit($Phone)){
			echo '-61';
			exit();
		}
		
		if(!(strlen($Phone) == 10)){
				echo '-60';
				exit();
			}
		

		if (
	  	!empty($FirstName) &&
	   	!empty($LastName) &&
	   	!empty($Email) &&
	   	!empty($Password_hash) &&
	   	!empty($Address) &&
	   	!empty($Phone)) {

			if (checkDuplicateEmail($con, $Email) || checkDuplicatePhone($con, $Phone)) {
				echo '-2';
			} else {
				$query = mysqli_prepare($con, "INSERT INTO Person ( FirstName, LastName, Email, Password, Phone, Address)
						  VALUES (?,?,?,?,?,?)");
				$query->bind_param("ssssis", $FirstName, $LastName, $Email, $Password_hash, $Phone, $Address);

				if ($query->execute()) {
					echo '1';
				} else {
					echo '0';
				}
			}
		} else {
			echo '-1';
		}
} else {
	echo "-7";
	exit();
}

function checkDuplicateEmail($con, $value) {
	$sql = "SELECT * FROM `Person` WHERE `Email`='$value'";

	$result = $con->query($sql);

	if ($result->num_rows > 0) {
		return true;
	} else {
		return false;
	}
}

function checkDuplicatePhone($con, $value) {
	$sql = "SELECT * FROM `Person` WHERE `Phone`='$value'";

	$result = $con->query($sql);

	if ($result->num_rows > 0) {
		return true;
	} else {
		return false;
	}
}


?>



