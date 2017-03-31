<?php

function areProductFieldsEmpty(& $errors){
  if(!isset($_POST['ProductName']) || empty($_POST['ProductName'])){
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Please fill in all the fields!</center></div>';
    return true;
  }

  if(!isset($_POST['ProductDescription']) || empty($_POST['ProductDescription'])){
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Please fill in all the fields!</center></div>';
    return true;
  }

  return false;
}

function hasDuplicateProductName($errors, $con, $ProductName){
  $sql = "SELECT * FROM Products WHERE ProductName='$ProductName'";

  $result = $con->query($sql);

  if ($result->num_rows > 0) {
    if(objectIsNotPerson($con, $result)){
      $errors[] = '<div class="alert alert-danger" role="alert"><center>This product already exists!</center></div>';
      return true;
    }
  }
  return false;
}

 ?>
