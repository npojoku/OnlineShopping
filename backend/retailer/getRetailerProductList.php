<?php

/* get list of products sold by current retailer */
function getRetailerProductList(){
  global $con;
  $ShopName = getShopName();

  // return mysql object
  $query = "SELECT p.ProductName, s.ProductId, s.Type, s.Quantity, s.Price
        FROM Products p, Sells s
        WHERE p.ProductId=s.ProductId and s.ShopName='$ShopName'";

  $obj = mysqli_query($con, $query);

  return $obj;
}

function sellsHasQuality($ProductId, $Type){
  global $con;
  $ShopName = getShopName();

  $sql = "SELECT * FROM Sells
    WHERE ProductId='$ProductId' AND Type='$Type' AND ShopName='$ShopName'
    AND QualityId is not null";

  $result = $con->query($sql);

  if ($result->num_rows > 0) {
    return true;
  } else {
    return false;
  }
}

  function getQualityName($ProductId, $Type){
    global $con;
    // return name
    $ShopName = getShopName();

    $sql = "SELECT q.Name FROM Sells s, Quality q
      WHERE ProductId='$ProductId' AND Type='$Type' AND ShopName='$ShopName'
      AND s.QualityId = q.QualityId";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        return $row['Name'];
      }
    } else {
      return false;
    }
  }
 ?>
