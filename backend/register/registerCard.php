<?php
include '../../backend/validation/cardValidationLibrary.php';
include '../../backend/account/addCard.php';

global $con;
$errors = array();

// request to add credit card to database for registration
if(isset($_POST['registerCard'])) {
  $hasEmptyFields = areCardFieldsEmpty($errors);

  if(!$hasEmptyFields){
    $CreditCard = $_POST['CreditCard'];
    $CreditExpDate = $_POST['CreditExpDate'];

    $isValid = isCreditCardValid($errors, $CreditCard);

    if($isValid){
      // add credit card to account
      if (!hasDuplicateCard($errors, $con, $CreditCard)) {

        if (addCard($con, $CreditCard, $CreditExpDate)) {
          // if query was a success navigate to home page
          header("Location: ../../frontend/php/productList.php");

        } else {
          // if query failed go to error page
          header("Location: ../../frontend/php/error.php");
        }

      }
    }
  }
}

?>
