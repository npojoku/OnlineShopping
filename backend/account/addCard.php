<?php
function addCard($con, $CreditCard, $CreditExpDate){

  $PersonId = getPersonId();
  $sql = "INSERT INTO CreditCard(PersonId, CreditCard, CreditExpDate)
    VALUES ('$PersonId','$CreditCard',STR_TO_DATE('$CreditExpDate','%Y-%m'))";

  $query = mysqli_prepare($con, $sql);

  return $query->execute();
}
?>
