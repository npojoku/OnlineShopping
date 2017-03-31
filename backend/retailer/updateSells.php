<?php

function updateSells($con, $ProductId, $Type, $Quantity, $Price){
  $ShopName = getPersonId();

  $sql = "UPDATE `Sells` SET `Quantity`='$Quantity',`Price`='$Price'
  WHERE ShopName = '$ShopName' AND ProductId = '$ProductId' AND Type='$Type'";

  $query = mysqli_prepare($con, $sql);

  return $query->execute();
}


 ?>
