<?php
require '../core.inc.php';
/*
Path: /self/userRegister.php/

Description: register as a new user

Input:
	$_POST
		'first_name'		(string) 
		'last_name'			(string) 
		'email'				(string) 
		'password'			(string) 
		'phone_number'		(string) 

Output
	1						sucessful
		
Error:
	0						failed

	-1						field must not be empty/null

	-2						email address/phone number already exist

	-300					first name too long max 15
	-301					only letter and space allowed in first name
	-310					last name too long max 15
	-311					only letter and space allowed in last name

	-40						password length must be 8 - 20
	-41						password contains symbols (No symbol allowed)
	-42						Password must include at least one number! 
	-43						Password must include at least one lower-case letter!
	-44						Password must include at least one Upper-case letter!

	-5						Wrong email Format

	-60						Phone number length is not 10
	-61						Phone number not only contain number

	-7						required field not set
*/

global $con;
if (isset($_POST['first_name'])&&
	isset($_POST['last_name'])&&
	isset($_POST['email'])&&
	isset($_POST['password'])&&
	isset($_POST['phone_number'])) {
		$first_name = $_POST['first_name'];
		if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) {
  			echo '-301';
  			exit();
		}
		if(strlen($first_name) > 15){
  				echo '-300';
  				exit();
  			} 

		$last_name = $_POST['last_name'];
		if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) {
  			echo '-311';
  			exit();
		}
		if(strlen($last_name) > 15){
  				echo '-310';
  				exit();
  		}

		$password = $_POST['password'];
		if( strlen($password) < 8 || strlen($password) >20) {
			echo '-40';
			exit();
		}
		if( preg_match("#\W+#", $password) ) {
			echo '-41';
			exit();
		}
		if( !preg_match("#[0-9]+#", $password) ) {
			echo '-42';
			exit();
		}
		if( !preg_match("#[a-z]+#", $password) ) {
			echo '-43';
			exit();
		}
		if( !preg_match("#[A-Z]+#", $password) ) {
			echo '-44';
			exit();
		}
		$password_hash = md5($password); //hash the password before saving

		$email = $_POST['email'];
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  			echo '-5';
			exit();
		}

		if(!ctype_digit($phone_number)){
			echo '-61';
			exit();
		}
		$phone_number = $_POST['phone_number'];
		if(!(strlen($phone_number) == 10)){
				echo '-60';
				exit();
			}
		

		if (
	  	!empty($first_name) &&
	   	!empty($last_name) &&
	   	!empty($email) &&
	   	!empty($password_hash) &&
	   	!empty($phone_number)) {

			if (checkDuplicateEmail($con, $email) || checkDuplicatePhone($con, $phone_number)) {
				echo '-2';
			} else {
				$query = mysqli_prepare($con, "INSERT INTO user ( first_name, last_name, email, password, phone_number)
						  VALUES (?,?,?,?,?)");
				$query->bind_param("ssssi", $first_name, $last_name, $email, $password_hash, $phone_number);

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
	$query = "SELECT * FROM `user` WHERE `email`='$value'";
	$query_run = mysqli_query($con, $query);
	$query_num_rows = mysqli_num_rows($query_run);

	if ($query_num_rows != 0) {
		return true;
	} else {
		return false;
	}
}

function checkDuplicatePhone($con, $value) {
	$query = "SELECT * FROM `user` WHERE `phone_number`='$value'";
	$query_run = mysqli_query($con, $query);
	$query_num_rows = mysqli_num_rows($query_run);

	if ($query_num_rows != 0) {
		return true;
	} else {
		return false;
	}
}


?>



