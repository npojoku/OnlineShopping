<?php
function deleteSells($con, $ProductId, $Type){
  $ShopName = getShopName();

  $sql = "DELETE FROM `Sells`
    WHERE ShopName='$ShopName' AND ProductId='$ProductId' AND Type='$Type'";

  $query = mysqli_prepare($con, $sql);

  return $query->execute();
}
 ?>
