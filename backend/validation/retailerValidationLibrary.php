<?php

include_once 'personValidationLibrary.php';

function areSellsFieldsEmpty(& $errors){
  // verify price and quantity are not empty
  if(!isset($_POST['Price']) || empty($_POST['Price'])){
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Please fill in all the fields!</center></div>';
    return true;
  }

  if(!isset($_POST['Quantity']) || empty($_POST['Quantity'])){
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Please fill in all the fields!</center></div>';
    return true;
  }

  return false;
}

function hasDuplicateShopProducts(& $errors, $con, $ProductId, $Type){
      // check for product/shop/used combination duplicate
      $ShopName = getShopName();

      $sql = "SELECT * FROM Sells WHERE ShopName like '$ShopName' AND ProductId=$ProductId AND Type=$Type";

      echo $sql;

      $result = $con->query($sql);

      if ($result->num_rows > 0) {
          $errors[] = '<div class="alert alert-danger" role="alert"><center>This product already exists!</center></div>';
          echo 'i passed!';
          return true;
      }
      echo 'i failed';
      return false;
}

function doesSellsExist($con, $ProductId, $Type){
  $ShopName = getShopName();

  $sql = "SELECT * FROM Sells
    WHERE ProductId='$ProductId' AND Type='$Type' AND ShopName='$ShopName'";

  $result = $con->query($sql);

  if ($result->num_rows > 0) {
    return true;
  } else {
    return false;
  }
}

 ?>
