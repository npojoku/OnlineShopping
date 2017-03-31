<?php

function updateCard($con, $CardId, $CreditCard, $CreditExpDate){
  $PersonId = getPersonId();

  $sql = "UPDATE `CreditCard` SET `CreditCard`='$CreditCard',`CreditExpDate`=STR_TO_DATE('$CreditExpDate','%Y-%m') WHERE CardId = '$CardId' AND PersonID = 'PeronId';"

  if ($con->query($sql)) {
    return true;
  } else {
    return false;
  }
}

 ?>
