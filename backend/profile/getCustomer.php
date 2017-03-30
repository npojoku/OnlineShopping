<?php
/* get personal information of current customer returned in sql object */

function getCustomer(){
  global $con;

  $PersonId = getPersonId();

  // return mysql object
  $query = "SELECT Email, Password, FirstName, LastName, Phone, Address
    FROM Person WHERE PersonId=$PersonId";
  $customer = mysqli_fetch_array(mysqli_query($con, $query));

  if($customer){
    return $customer;
  } else {
    // if query failed go to error page
    header("Location: ../../frontend/php/error.php");
  }
}

 ?>
