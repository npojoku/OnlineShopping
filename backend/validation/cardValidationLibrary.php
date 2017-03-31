<?php

include_once '../../backend/core.inc.php';

function areCardFieldsEmpty(& $errors){
  // verify email has been entered
  if(!isset($_POST['CreditCard']) || empty($_POST['CreditCard'])){
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Please include a valid credit card number.</center></div>';
    return true;
  }

  // verify password has been entered
  if(!isset($_POST['CreditExpDate']) || empty($_POST['CreditExpDate'])){
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Please include a valid expiration date.</center></div>';
    return true;
  }

  return false;
}

function isCardIdEmpty(& $errors){
  if(!isset($_POST['CardId']) || empty($_POST['CardId'])){
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Internal error: card id</center></div>';
    return true;
  }
}

function isCreditCardListValid(& $errors, $CreditCardList){
  foreach($CreditCardList as $Card){
    if(! isCreditCardValid($errors, $Card)) return false;
  }
  return true;
}

function isCreditCardValid(& $errors, $CreditCard){
  // check that card # is valid
  if(!ctype_digit($CreditCard) || strlen($CreditCard) != 16){
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Credit card number is invalid</center></div>';
    return false;
  }

  return true;
}

function hasDuplicateCard(& $errors, $con, $CreditCard){
  $PersonId = getPersonId();

  $sql = "SELECT * FROM CreditCard WHERE CreditCard='$value' AND PersonId='$PersonId'";

  $result = $con->query($sql);

  if ($result->num_rows > 0) {
    $errors[] = '<div class="alert alert-danger" role="alert"><center>This credit card is already registered.</center></div>';
    return true;
  } else {
    return false;
  }
}

function doesCardExist($con, $CardId){
  $PersonId = getPersonId();

  $sql = "SELECT * FROM CreditCard WHERE CardId='$CardId' AND PersonId='$PersonId'";

  $result = $con->query($sql);

  if ($result->num_rows > 0) {
    return true;
  } else {
    return false;
  }
}
 ?>
