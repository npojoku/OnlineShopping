<?php

include_once '../../backend/core.inc.php';
/*
  Function library validating all atributes
  associated to a customer or retailer
  */
function areCustomerFieldsEmpty(& $errors, $isRetailer){
  $fields = array('FirstName', 'LastName', 'Email', 'Password', 'Phone', 'Address');

  foreach($fields AS $fieldname) {
    if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
      $errors[] = '<div class="alert alert-danger" role="alert"><center>Please fill in all the fields!</center></div>';
      return true;
    }
  }

  // verify retailer fields
  if($isRetailer) {
    return areRetailerFieldsEmpty($errors);
  }

  return false;
}

function areRetailerFieldsEmpty(& $errors){
  // verify empty retailer fields
  if(!isset($_POST['ShopName']) || empty($_POST['ShopName'])){
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Please fill in all the fields!</center></div>';
    return true;
  }

  // verify password has been entered
  if(!isset($_POST['DepositAccount']) || empty($_POST['DepositAccount'])){
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Please fill in all the fields!</center></div>';
    return true;
  }

  return false;
}

function isFirstNameValid(& $errors, $FirstName){
  if (!preg_match("/^[a-zA-Z ]*$/",$FirstName)) {
      $errors[] = '<div class="alert alert-danger" role="alert"><center>Only letter and space allowed in first name!</center></div>';
      return false;
  }

  if(strlen($FirstName) > 15){
    $errors[] = '<div class="alert alert-danger" role="alert"><center>First name is too long!</center></div>';
    return false;
  }

  return true;
}

function isLastNameValid(& $errors, $LastName){
  if (!preg_match("/^[a-zA-Z ]*$/",$LastName)) {
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Only letter and space allowed in last name!</center></div>';
    return false;
  }

  if(strlen($LastName) > 15){
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Last name is too long!</center></div>';
    return false;
  }

  return true;
}

function isPasswordChanged($con, $Password){
  // if the only duplicate row it finds is itself, there are no duplicates
  if(isLoggedIn()) {
    $PersonId = getPersonId();

    $sql = "SELECT Password FROM Person WHERE PersonId='$PersonId'";

    $result = $con->query($sql);

    if($result->fetch_assoc()['Password'] != $Password) return true;
  }
  return false;
}

function isPasswordValid(& $errors, $Password){
  if( strlen($Password) < 8 || strlen($Password) >20) {
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Password length must be 8 - 20!</center></div>';
    return false;
  }

  if( preg_match("#\W+#", $Password) ) {
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Password contains symbols (No symbol allowed)!</center></div>';
    return false;
  }

  if( !preg_match("#[0-9]+#", $Password) ) {
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Password must include at least one number!</center></div>';
    return false;
  }

  if( !preg_match("#[a-z]+#", $Password) ) {
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Password must include at least one lower-case letter!</center></div>';
    return false;
  }

  if( !preg_match("#[A-Z]+#", $Password) ) {
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Password must include at least one Upper-case letter!</center></div>';
    return false;
  }

  return true;
}

function isPhoneValid(& $errors, $Phone){
  if(!ctype_digit($Phone)){
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Phone number can only contain numbers!</center></div>';
    return false;
  }

  if(strlen($Phone) != 10){
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Phone number length must be 10!</center></div>';
    return false;
  }

  return true;
}

function isDepositAccountValid(& $errors, $DepositAccount){
  if(! (strlen($DepositAccount) >= 9 && strlen($DepositAccount) <= 17)){
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Deposit account number is an invalid length.</center></div>';
    return false;
  }

  return true;
}

function hasDuplicateEmail(& $errors, $con, $value) {
	$sql = "SELECT * FROM `Person` WHERE `Email`='$value'";

	$result = $con->query($sql);

  if ($result->num_rows > 0) {
    if(objectIsNotPerson($con, $result)){
      $errors[] = '<div class="alert alert-danger" role="alert"><center>This email is associated with a user.</center></div>';
      return true;
    }
  }

  return false;
}

function hasDuplicatePhone(& $errors, $con, $value) {
	$sql = "SELECT * FROM `Person` WHERE `Phone`='$value'";

	$result = $con->query($sql);

	if ($result->num_rows > 0) {
    if(objectIsNotPerson($con, $result)){
      $errors[] = '<div class="alert alert-danger" role="alert"><center>This phone number is associated with a user.</center></div>';
  		return true;
    }
	}
	return false;
}

function hasDuplicateShopName(& $errors, $con, $value) {
	$sql = "SELECT * FROM `Retailers` WHERE `ShopName`='$value'";

	$result = $con->query($sql);

	if ($result->num_rows > 0) {
    if(objectIsNotPerson($con, $result)){
      $errors[] = '<div class="alert alert-danger" role="alert"><center>This shop name is associated with a user.</center></div>';
  		return true;
    }
	}
	return false;
}

// helper function for hasDuplicates
function objectIsNotPerson($con, & $result){
  // if the only duplicate row it finds is itself, there are no duplicates
  if(isLoggedIn()) {

    $PersonId = getPersonId();

    while($row = $result->fetch_assoc()) {
      if($row['PersonId'] != $PersonId){
        $errors[] = '<div class="alert alert-danger" role="alert"><center>This email is associated with a user.</center></div>';
        return true;
      }
    }
    return false;
  }
  return true;
}
?>
