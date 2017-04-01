<?php
include '../../backend/validation/productValidationLibrary.php';

global $con;
$errors = array();

// request to create a new product
if(isset($_POST['addProduct'])) {
  $hasEmptyFields = areProductFieldsEmpty($errors);

  if(! $hasEmptyFields){
    $ProductName = $_POST['ProductName'];
    $ProductDescription = $_POST['ProductDescription'];

    if(! hasDuplicateProductName($errors, $con, $ProductName)){

      // create product and redirect
      if(createProduct($con, $ProductName, $ProductDescription)){
        $sql1 = "SELECT ProductId FROM Products WHERE ProductName = '$ProductName'";
        if($result=mysqli_query($con,$sql1)){
          $pida = mysqli_fetch_array($result, MYSQLI_ASSOC);
          $pid = $pida['ProductId'];
          $sql2 = "INSERT INTO Rating(ProductId, Rating, OrderId) VALUES($pid, 0, 0)";
          $query2 = mysqli_prepare($con, $sql2); 
          if($query2->execute()){
            header("Location: ../createShells.php");
          } else {
            // if query failed go to error page
            header("Location: ../../frontend/php/error.php");
          }
        } else {
          header("Location: ../../frontend/php/error.php");
        }    
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
