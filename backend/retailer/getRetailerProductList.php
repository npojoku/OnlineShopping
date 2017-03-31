<?php

/* get list of products sold by current retailer */
function getRetailerProductList(){
  global $con;
  $ShopName = getShopName();

  // return mysql object
  $query = "SELECT ProductId, Type, Quantity, QualityId, Price
    FROM Sells WHERE ShopName = '$ShopName' ORDER BY ProductId";

  $obj = mysqli_query($con, $query);

  return $obj;
}
 ?>
