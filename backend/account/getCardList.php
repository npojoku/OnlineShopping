<?php

/* get personal information of current user specific to retailer */
function getCardList(){
  global $con;

  $PersonId = getPersonId();
  // return mysql object
  $query = "SELECT CreditCard, CreditExpDate
    FROM CreditCard WHERE PersonId=$PersonId";

  $obj = mysqli_query($con, $query);

  return $obj;
}

 ?>
