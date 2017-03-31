<?php

/* get list of all unique products in the database */
function getQualityList(){
  global $con;

  // return mysql object
  $query = "SELECT QualityId, Name FROM Quality";

  $obj = mysqli_query($con, $query);

  return $obj;
}
 ?>
