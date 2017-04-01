<?php
  include_once 'addCard.php';
  include_once 'updateCard.php';
  include_once 'deleteCard.php';

  // update credit card list to be consistent with database
  // user may choose to delete, add, or update
  function updateCardList($con, $CreditIdList, $CreditCardList, $CreditExpDateList){
    $result = true;

    // iterate through each card and process individually
    foreach($CreditIdList as $key => $CardId){

      if($CardId === "new"){
        // if card does not exist, add to database
        $result = addCard($con, $CreditCardList[$key], $CreditExpDateList[$key]);

      } else if(doesCardExist($con, $CardId)){
        // if card exists, update
        $result = updateCard($con, $CardId, $CreditCardList[$key], $CreditExpDateList[$key]);

      } else if(doesCardExist($con, abs($CardId))){
        // if card id is negative it has been marked for deletion
        $result = deleteCard($con, abs($CardId));
      }

      if(!$result) return $result;
    }

    return $result;
  }

 ?>
