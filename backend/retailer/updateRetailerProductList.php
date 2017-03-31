<?php
/* update changed personal information of current user */
include_once '../../backend/validation/retailerValidationLibrary.php';
include 'deleteSells.php';
include 'updateSells.php';

global $con;
$errors = array();

if(isset($_POST['updateProducts'])){
  // find retailer update type
  // add retailer is check box is marked
  // update if user was already a retailer
  $isAddRetailer = isset($_POST['registerAsRetailer']);
  $isUpdateRetailer = isRetailer();

  // make sure no fields are empty
  $hasEmptyFields = areSellsFieldsEmpty($errors);

  if(!$hasEmptyFields) {
    $ProductIdList = $_POST['ProductId'];
    $TypeList = $_POST['Type'];
    $QuantityList = $_POST['Quantity'];
    $PriceList = $_POST['Price'];

      // update sells table
      $result = updateRetailerProductList($con, $ProductIdList, $TypeList, $QuantityList, $PriceList);

      if(!$result) header("Location: ../../frontend/php/error.php");
    }
}

// update retailer sells list to be consistent with database
// user may choose to delete, add, or update
function updateRetailerProductList($con, $ProductIdList, $TypeList, $QuantityList, $PriceList){
  $result = true;

  // iterate through each card and process individually
  foreach($ProductIdList as $key => $ProductId){

    if(doesSellsExist($con, $ProductId, $TypeList[$key])){

      // if card exists, update
      $result = updateSells($con, $ProductId, $TypeList[$key], $QuantityList[$key], $PriceList[$key]);

    } else if(doesSellsExist($con, abs($ProductId), $TypeList[$key])){
      // if card id is negative it has been marked for deletion
      $result = deleteSells($con, abs($ProductId), $TypeList[$key]);

    }

    if(!$result) return $result;
  }

  return $result;
}
 ?>
