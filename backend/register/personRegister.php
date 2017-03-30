<?php
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

	// user is registering as a customer
	$isRetailer = isset($_POST['registerAsRetailer']);

	$fields = array('FirstName', 'LastName', 'Email', 'Password', 'Phone', 'Address');
	$emptyFields = false;
	foreach($fields AS $fieldname) {
	  if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Please fill in all the fields!</center></div>';
	    $emptyFields = true;
      break;
	  }
	}

	if($isRetailer && !$emptyFields){
		// verify empty retailer fields
		// verify email has been entered
		if(!isset($_POST['ShopName']) || empty($_POST['ShopName'])){
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Please fill in all the fields!</center></div>';
			$emptyFields = true;
		}

		// verify password has been entered
		if(!isset($_POST['DepositAccount']) || empty($_POST['DepositAccount'])){
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Please fill in all the fields!</center></div>';
			$emptyFields = true;
		}
	}

	if(!$emptyFields) {
		$validateError = false;

		// validate first name
		$FirstName = $_POST['FirstName'];

		if (!preg_match("/^[a-zA-Z ]*$/",$FirstName)) {
			  $errors[] = '<div class="alert alert-danger" role="alert"><center>Only letter and space allowed in first name!</center></div>';
				$validateError = true;
		}

		if(strlen($FirstName) > 15){
			$errors[] = '<div class="alert alert-danger" role="alert"><center>First name is too long!</center></div>';
			$validateError = true;
  			}

		// validate last name
		$LastName = $_POST['LastName'];

		if (!preg_match("/^[a-zA-Z ]*$/",$LastName)) {
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Only letter and space allowed in last name!</center></div>';
			$validateError = true;
		}

		if(strlen($LastName) > 15){
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Last name is too long!</center></div>';
			$validateError = true;
  		}

		// validate password
		$Password = $_POST['Password'];

		if( strlen($Password) < 8 || strlen($Password) >20) {
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Password length must be 8 - 20!</center></div>';
			$validateError = true;
		}

		if( preg_match("#\W+#", $Password) ) {
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Password contains symbols (No symbol allowed)!</center></div>';
			$validateError = true;
		}

		if( !preg_match("#[0-9]+#", $Password) ) {
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Password must include at least one number!</center></div>';
			$validateError = true;
		}

		if( !preg_match("#[a-z]+#", $Password) ) {
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Password must include at least one lower-case letter!</center></div>';
			$validateError = true;
		}

		if( !preg_match("#[A-Z]+#", $Password) ) {
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Password must include at least one Upper-case letter!</center></div>';
			$validateError = true;
		}

		$Password_hash = md5($Password); //hash the Password before saving

		$Email = $_POST['Email'];
		$Address = $_POST['Address'];

		// validate phone #
		$Phone = $_POST['Phone'];
		if(!ctype_digit($Phone)){
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Phone number can only contain numbers!</center></div>';
			$validateError = true;
		}

		if(strlen($Phone) != 10){
			$errors[] = '<div class="alert alert-danger" role="alert"><center>Phone number length must be 10!</center></div>';
			$validateError = true;
		}

		// validate retailer fields
		$ShopName = $_POST['ShopName'];
		$DepositAccount = $_POST['DepositAccount'];
		if($isRetailer){
			if(! (strlen($DepositAccount) >= 9 && strlen($DepositAccount) <= 17)){
				$errors[] = '<div class="alert alert-danger" role="alert"><center>Deposit account number is an invalid length.</center></div>';
				$validateError = true;
			}
		}

		if (!$validateError) {

			if (checkDuplicateEmail($con, $Email) || checkDuplicatePhone($con, $Phone)) {
				$errors[] = '<div class="alert alert-danger" role="alert"><center>This email or phone is associated with a user.</center></div>';
			} else if(checkDuplicateShopName($con, $ShopName)){
				$errors[] = '<div class="alert alert-danger" role="alert"><center>This shop name is associated with a user.</center></div>';
			} else {
				$query = mysqli_prepare($con, "INSERT INTO Person ( FirstName, LastName, Email, Password, Phone, Address)
						  VALUES (?,?,?,?,?,?)");
				$query->bind_param("ssssis", $FirstName, $LastName, $Email, $Password_hash, $Phone, $Address);

				if ($query->execute()) {
					// login to website
					loginUser($Email, $Password_hash);

					if($isRetailer){
						if(!setRetailerInformation($ShopName, $DepositAccount)){
								// redirect to error page on error
								header("Location: ../../frontend/php/error.php");
						}

						// set session user type
						setUserType();
					}

					header("Location: ../../frontend/php/registerCard.php");

				} else {
					header("Location: ../../frontend/php/error.php");
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

function checkDuplicateShopName($con, $value) {
	$sql = "SELECT * FROM `Retailers` WHERE `ShopName`='$value'";

	$result = $con->query($sql);

	if ($result->num_rows > 0) {
		return true;
	} else {
		return false;
	}
}

function setRetailerInformation($ShopName, $DepositAccount){
	global $con;
	$PersonId = getPersonId();

	$sql = "INSERT INTO Retailers (PersonId, ShopName, DepositAccount)
						VALUES ('$PersonId','$ShopName','$DepositAccount')";

	$query = mysqli_prepare($con, $sql);

	if($query->execute()){
		return true;
	}
	return false;
}

?>
