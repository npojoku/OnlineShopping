<?php

function deleteCard($con, $CardId){
  $PersonId = getPersonId();

  $sql = "DELETE FROM `CreditCard` WHERE PersonID = '$PersonId' and CardId = '$CardId'";

  $query = mysqli_prepare($con, $sql);

  return $query->execute();
}

?>
