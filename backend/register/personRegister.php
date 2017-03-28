<?php
//require '../core.inc.php';
/*
Path: /self/personRegister.php/

Description: register as a new user

Input:
	$_POST
		'FirstName'			(string) 
		'LastName'			(string) 
		'Email'				(string) 
		'Password'			(string) 
		'Phone'				(string) 
		'Address'    		(string)

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
$errors = array();
if (isset($_POST['register'])) {

	$fields = array('FirstName', 'LastName', 'Email', 'Password', 'Phone', 'Address');
	$emptyFields = false;
	foreach($fields AS $fieldname) {
	  if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Please fill in all the fields!</center></div>';
	    $emptyFields = true;
      break;
	  }
	}

	if(!$emptyFields) {
		$validateError = false;
		$FirstName = $_POST['FirstName'];
		if (!preg_match("/^[a-zA-Z ]*$/",$FirstName)) {
			  $errors[] = '<div class="alert alert-danger" role="alert"><center>Only letter and space allowed in first name!</center></div>';
				$validateError = true;
  			//echo '-301';
  			//exit();
		}
		if(strlen($FirstName) > 15){
			$errors[] = '<div class="alert alert-danger" role="alert"><center>First name is too long!</center></div>';
			$validateError = true;
  				//echo '-300';
  				//exit();
  			}

		$LastName = $_POST['LastName'];
		if (!preg_match("/^[a-zA-Z ]*$/",$LastName)) {
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Only letter and space allowed in last name!</center></div>';
			$validateError = true;
  			//echo '-311';
  			//exit();
		}
		if(strlen($LastName) > 15){
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Last name is too long!</center></div>';
			$validateError = true;
  				//echo '-310';
  				//exit();
  		}

		$Password = $_POST['Password'];
		if( strlen($Password) < 8 || strlen($Password) >20) {
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Password length must be 8 - 20!</center></div>';
			$validateError = true;
			//echo '-40';
			//exit();
		}
		if( preg_match("#\W+#", $Password) ) {
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Password contains symbols (No symbol allowed)!</center></div>';
			$validateError = true;
			//echo '-41';
			//exit();
		}

		if( !preg_match("#[0-9]+#", $Password) ) {
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Password must include at least one number!</center></div>';
			$validateError = true;
			//echo '-42';
			//exit();
		}
		if( !preg_match("#[a-z]+#", $Password) ) {
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Password must include at least one lower-case letter!</center></div>';
			$validateError = true;
			//echo '-43';
			//exit();
		}
		if( !preg_match("#[A-Z]+#", $Password) ) {
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Password must include at least one Upper-case letter!</center></div>';
			$validateError = true;
			//echo '-44';
			//exit();
		}
		$Password_hash = md5($Password); //hash the Password before saving

		$Email = $_POST['Email'];
		$Address = $_POST['Address'];

		$Phone = $_POST['Phone'];
		if(!ctype_digit($Phone)){
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Phone number can only contain number!</center></div>';
			$validateError = true;
			//echo '-61';
			//exit();
		}

		if(strlen($Phone) != 10){
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Phone number length must be 10!</center></div>';
			$validateError = true;
				//echo '-60';
				//exit();
			}


		if (!$validateError) {

			if (checkDuplicateEmail($con, $Email) || checkDuplicatePhone($con, $Phone)) {
				echo '-2';
			} else {
				$query = mysqli_prepare($con, "INSERT INTO Person ( FirstName, LastName, Email, Password, Phone, Address)
						  VALUES (?,?,?,?,?,?)");
				$query->bind_param("ssssis", $FirstName, $LastName, $Email, $Password_hash, $Phone, $Address);

				if ($query->execute()) {
					if (isset($_POST['retailer'])) {
					header("Location: http://localhost/cpsc304_project_30/frontend/php/registerRetailer.php");
					exit();
				} else {
					header("Location: http://localhost/cpsc304_project_30/frontend/php/cardInfo.php");
					exit();
				}
					//echo '1';
				} else {
					echo '0';
				}
			}
		}
  }
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
