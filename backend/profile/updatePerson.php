<?php
/* update changed personal information of current user */
include '../../backend/validation/personValidationLibrary.php';
include '../../backend/validation/cardValidationLibrary.php';
include 'addRetailer.php';
include '../../backend/account/updateCardList.php';

global $con;
$errors = array();

if(isset($_POST['updatePerson'])){
  // find retailer update type
  // add retailer is check box is marked
  // update if user was already a retailer
  $isAddRetailer = isset($_POST['registerAsRetailer']);
  $isUpdateRetailer = isRetailer();

  // make sure no fields are empty
  $hasEmptyFields = areCustomerFieldsEmpty($errors, $isAddRetailer || $isUpdateRetailer);
  $hasEmptyFields |= areCardFieldsEmpty($errors);
  $hasEmptyFields |= isCardIdEmpty($errors);

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
    if(isPasswordChanged($con, $Password)){
      $isValid &= isPasswordValid($con, $errors, $Password);
      $Password_hash = md5($Password); //hash the Password before saving
    } else {
      $Password_hash = $Password;
    }


    $Email = $_POST['Email'];
    $Address = $_POST['Address'];

    // validate phone #
    $Phone = $_POST['Phone'];
    $isValid &= isPhoneValid($errors, $Phone);

    // validate retailer fields
    $ShopName = $_POST['ShopName'];
    $DepositAccount = $_POST['DepositAccount'];
    if($isAddRetailer || $isUpdateRetailer){
      $isValid &= isDepositAccountValid($errors, $DepositAccount);
    }

    // validate credit card fields
    $CreditIdList = $_POST['CardId'];
    $CreditCardList = $_POST['CreditCard'];
    $CreditExpDateList = $_POST['CreditExpDate'];

    $isValid &= isCreditCardListValid($errors, $CreditIdList, $CreditCardList);

    if($isValid){
      if (!hasDuplicateEmail($errors, $con, $Email) &&
        !hasDuplicatePhone($errors, $con, $Phone) &&
        ! hasDuplicateShopName($errors, $con, $ShopName)){

        // update person profile
        $result = updateCustomer($con, $Email, $Password_hash, $FirstName, $LastName, $Phone, $Address);


        if($isUpdateRetailer){
          // update retailer profile
          $result = updateRetailer($con, $ShopName, $DepositAccount);
        } else if($isAddRetailer){
          // add retailer profile for this user
          $result = addRetailer($con, $ShopName, $DepositAccount);
        }

        // update credit card table
        $result = updateCardList($con, $CreditIdList, $CreditCardList, $CreditExpDateList);

        if(!$result) header("Location: ../../frontend/php/error.php");
      }
    }
  }
}

function updateCustomer($con, $Email, $Password_hash, $FirstName, $LastName, $Phone, $Address){
  $PersonId = getPersonId();

  $sql = "UPDATE Person
        SET Phone='$Phone',Password='$Password_hash',Address='$Address',
          FirstName='$FirstName',LastName='$LastName',Email='$Email'
        WHERE PersonId='$PersonId'";

  $query = mysqli_prepare($con, $sql);
  if($query->execute()){
    return true;
  }
  return false;
}

function updateRetailer($con, $ShopName, $DepositAccount){
  $PersonId = getPersonId();

  $sql = "UPDATE Retailers
        SET ShopName='$ShopName',DepositAccount='$DepositAccount'
        WHERE PersonId='$PersonId'";

  $query = mysqli_prepare($con, $sql);
  if($query->execute()){
    return true;
  }
  return false;
}
 ?>
