<?php
/*
Path: /self/personRegister.php/

Description: register as a new user
*/
include '../../backend/validation/personValidationLibrary.php';
include '../../backend/profile/addRetailer.php';

global $con;
$errors = array();

if (isset($_POST['register'])) {

	// user is registering as a customer
	$isRetailer = isset($_POST['registerAsRetailer']);

	// make sure no fields are empty
	$hasEmptyFields = areCustomerFieldsEmpty($errors, $isRetailer);

	if(!$hasEmptyFields) {
		$isValid = true;

		// validate first name
		$FirstName = $_POST['FirstName'];
		$isValid &= isFirstNameValid($errors, $FirstName);

		// validate last name
		$LastName = $_POST['LastName'];
		$isValid &= isLastNameValid($errors, $LastName);

		// validate password
		$Password = $_POST['Password'];
		$isValid &= isPasswordValid($errors, $Password);
		$Password_hash = md5($Password); //hash the Password before saving

		$Email = $_POST['Email'];
		$Address = $_POST['Address'];

		// validate phone #
		$Phone = $_POST['Phone'];
		$isValid &= isPhoneValid($errors, $Phone);

		// validate retailer fields
		$ShopName = $_POST['ShopName'];
		$DepositAccount = $_POST['DepositAccount'];
		if($isRetailer){
			$isValid &= isDepositAccountValid($errors, $DepositAccount);
		}

		if ($isValid) {

			if (!hasDuplicateEmail($errors, $con, $Email) &&
				!hasDuplicatePhone($errors, $con, $Phone) &&
				! hasDuplicateShopName($errors, $con, $ShopName)){

				$query = mysqli_prepare($con, "INSERT INTO Person ( FirstName, LastName, Email, Password, Phone, Address)
						  VALUES (?,?,?,?,?,?)");
				$query->bind_param("ssssis", $FirstName, $LastName, $Email, $Password_hash, $Phone, $Address);

				if ($query->execute()) {
					// login to website
					loginUser($Email, $Password_hash);

					if($isRetailer){
						if(! addRetailer($con, $ShopName, $DepositAccount)){
								// redirect to error page on error
								header("Location: ../../frontend/php/error.php");
						}
				}

					header("Location: ../../frontend/php/registerCard.php");

				} else {
					header("Location: ../../frontend/php/error.php");
				}
			}
		}
  }
}

?>
