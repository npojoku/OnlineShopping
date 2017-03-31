<?php

/* get list of all unique products in the database */
function getProductList(){
  global $con;

  // return mysql object
  $query = "SELECT ProductId, ProductName, ProductDescription
    FROM Products";

  $obj = mysqli_query($con, $query);

  return $obj;
}
 ?>
