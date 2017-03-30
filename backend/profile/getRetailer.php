<?php
/* get personal information of current user specific to retailer */
function getRetailer(){
  global $con;

  $PersonId = getPersonId();
  // return mysql object
  $query = "SELECT ShopName, DepositAccount
    FROM Retailers WHERE PersonId=$PersonId";

  return mysqli_fetch_array(mysqli_query($con, $query));
}

 ?>
