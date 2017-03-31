<?php

/* get list of products sold by current retailer */
function getRetailerProductList(){
  global $con;
  $ShopName = getShopName();

  // return mysql object
  $query = "SELECT p.ProductName, s.ProductId, s.Type, s.Quantity, q.Name as QualityName, s.Price
        FROM Products p, Sells s, Quality q
        WHERE p.ProductId=s.ProductId and s.QualityId = q.QualityId and s.ShopName='$ShopName'";

  $obj = mysqli_query($con, $query);

  return $obj;
}
 ?>
