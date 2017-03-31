<?php
include '../../backend/validation/productValidationLibrary.php';

global $con;
$errors = array();

// request to create a new product
if(isset($_POST['createProduct'])) {
  $hasEmptyFields = areProductFieldsEmpty($errors);

  if(! $hasEmptyFields){
    $ProductName = $_POST['ProductName'];
    $ProductDescription = $_POST['ProductDescription'];

    if(! hasDuplicateProductName($errors, $con, $ProductName)){

      // create product and redirect
      if(createProduct($con, $ProductName, $ProductDescription)){
        // return to manage products page
        header("Location: ../../frontend/php/manageProducts.php");
      } else {
        // if query failed go to error page
        header("Location: ../../frontend/php/error.php");
      }
    }

  }
}

// create new product in database
function createProduct($con, $ProductName, $ProductDescription){
  $PersonId = getPersonId();
  $sql = "INSERT INTO Products(ProductName, ProductDescription)
    VALUES ('$ProductName','$ProductDescription')";

  $query = mysqli_prepare($con, $sql);

  return $query->execute();
}

?>
