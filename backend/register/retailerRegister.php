<?php
require '../core.inc.php';
require '../session.php';
/*
Path: /register/retailerRegister.php/

Description: register as a new retailer

Input:
		$_POST
			'ShopName'		(string)
			'DepositAccount'	(string)
Output
		1				successful


Error:
	0						failed
	-1						no session
	-2						Duplicate ShopName
	-7						required field not set
*/

global $con;
$errors = array();

// request to register retailer
if(isset($_POST['registerRetailer'])) {
	$hasError = false;

	// verify shop name
	if(!isset($_POST['ShopName']) || empty($_POST['ShopName'])){
		$errors[] = '<div class="alert alert-danger" role="alert"><center>Please include your vendor name.</center></div>';
		$hasError = true;
	} else {
		// TODO more checking
	}

	// verify deposit account
	if(!isset($_POST['DepositAccount']) || empty($_POST['DepositAccount'])){
		$errors[] = '<div class="alert alert-danger" role="alert"><center>Please include your direct deposit number for earnings.</center></div>';
		$hasError = true;
	} else {
		// TODO more checking
	}


// TODO refactoring from here

if (isset($_POST['ShopName'])&&
	isset($_POST['DepositAccount'])) {

		$ShopName = $_POST['ShopName'];
		$DepositAccount = $_POST['DepositAccount'];
		if(checkDuplicateShopName($con, $ShopName)){
			echo "-2";
			exit();
		}

		$query = mysqli_prepare($con, "INSERT INTO Retailers (PersonId, ShopName, DepositAccount)
						  VALUES (?,?,?)");
		$query->bind_param("iss", $PersonId, $ShopName, $DepositAccount);

		if ($query->execute()) {
			echo '1';
			exit();
		} else {
			echo '0';
			exit();
				}
	} else {
	echo "-7";
	exit();
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

?>
