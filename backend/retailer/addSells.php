<?php
include_once '../../backend/validation/retailerValidationLibrary.php';

global $con;
$errors = array();

// request to create a new product in shop
if(isset($_POST['createSells'])) {
  $hasEmptyFields = areSellsFieldsEmpty($errors);

  if(! $hasEmptyFields){
    $ProductId = $_POST['ProductId'];
    $QualityId = $_POST['QualityId'];
    $Quantity = $_POST['Quantity'];
    $Price = $_POST['Price'];

    // set used to appropriate value
    if(isset($_POST['isUsed'])) $Type = 0;
    else $Type = 1;

    if(! hasDuplicateShopProducts($errors, $con, $ProductId, $Type)){

      // create product and redirect
      if(createSells($con, $ProductId, $QualityId, $Quantity, $Price, $Type)){
        // return to manage products page
        header("Location: ../../frontend/php/manageProducts.php");
      } else {
        // if query failed go to error page
        //header("Location: ../../frontend/php/error.php");
        echo 'an errro happened';
      }
    }

  }
}

function createSells($con, $ProductId, $QualityId, $Quantity, $Price, $Type){
  $ShopName = getShopName();
  if($Type == 1){
    // new product
    $sql = "INSERT INTO `Sells`(`ProductId`, `ShopName`, `Type`, `Quantity`, Price)
      VALUES ('$ProductId','$ShopName','$Type','$Quantity','$Price')";
  } else {
    // used product
    $sql = "INSERT INTO `Sells`(`ProductId`, `ShopName`, `Type`, `Quantity`, `QualityId`, `Price`)
      VALUES ('$ProductId','$ShopName','$Type','$Quantity','$QualityId','$Price')";
  }


  $query = mysqli_prepare($con, $sql);

  return $query->execute();
}

 ?>
