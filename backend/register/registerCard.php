<?php
include '../../backend/validation/cardValidationLibrary.php';

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

        $PersonId = getPersonId();
        $sql = "INSERT INTO CreditCard(PersonId, CreditCard, CreditExpDate)
          VALUES ('$PersonId','$CreditCard',STR_TO_DATE('$CreditExpDate','%Y-%m'))";

        $query = mysqli_prepare($con, $sql);


        if ($query->execute()) {
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
