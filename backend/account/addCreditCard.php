<?php

global $con;
$errors = array();

// request to add credit card to database for registration
// TODO add more cases here for user profile page
if(isset($_POST['cardInfo'])) {
  $hasErrror = false;
  $CreditCard = $_POST['CreditCard'];
  $CreditExpDate = $_POST['CreditExpDate'];


  // verify email has been entered
  if(!isset($_POST['CreditCard']) || empty($_POST['CreditCard'])){
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Please include a valid credit card number.</center></div>';
    $hasError = true;
  } else {
    // validate credit card
    $CreditCard = $_POST['CreditCard'];

    // check that card # is valid
    if(!ctype_digit($CreditCard) || strlen($CreditCard) != 16){
      $errors[] = '<div class="alert alert-danger" role="alert"><center>Credit card number is invalid</center></div>';
      $hasError = true;
    }
  }

  // verify password has been entered
  if(!isset($_POST['CreditExpDate']) || empty($_POST['CreditExpDate'])){
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Please include a valid expiration date.</center></div>';
    $hasError = true;
  } else {
    $CreditExpDate = $_POST['CreditExpDate'];
  }

  if(!$hasError){
    // add credit card to account
    if (checkDuplicateCard($con, $CreditCard)) {
      $errors[] = '<div class="alert alert-danger" role="alert"><center>This credit card is already registered.</center></div>';
    } else {
      $sql = "INSERT INTO CreditCard(PersonId, CreditCard, CreditExpDate)
        VALUES ('$PersonId','$CreditCard','$CreditExpDate')";
      echo $sql;
      $query = mysqli_prepare($con, $sql);


      if ($query->execute()) {
        //header("Location: ../../frontend/php/viewProducts.php");

      } else {
        //header("Location: ../../frontend/php/error.php");
      }

    }
  }
}

function checkDuplicateCard($con, $value) {
	$sql = "SELECT * FROM CreditCard WHERE CreditCard='$value' AND PeronId='$PersonId'";

	$result = $con->query($sql);

	if ($result->num_rows > 0) {
		return true;
	} else {
		return false;
	}
}

?>