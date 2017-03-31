<?php

if(isset($_POST['isFinished'])){
  // retailer has marked order as finished
  $OrderId = $_POST['OrderId'];

  // mark order as completed
  $sql = "UPDATE Orders SET OrderStatus=1 WHERE OrderId = '$OrderId';";

  $query = mysqli_prepare($con, $sql);

  $query->execute();
}

 ?>
