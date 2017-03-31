<?php

function updateCard($con, $CardId, $CreditCard, $CreditExpDate){
  $PersonId = getPersonId();

  $sql = "UPDATE `CreditCard`
    SET `CreditCard`='$CreditCard',`CreditExpDate`=STR_TO_DATE('$CreditExpDate','%Y-%m')
    WHERE CardId = '$CardId' AND PersonId = '$PersonId'";

  $query = mysqli_prepare($con, $sql);

  return $query->execute();
}

 ?>
