
<?php if(isset($_GET['id']) && isset($_GET['rating'])){
  $orderid = $_GET['id'];
  $rating = $_GET['rating'];
  $PersonId = getPersonId();
  $productid = "SELECT ProductId FROM Orders WHERE PersonId = $PersonId && OrderId = $id";
}

  $query = mysqli_prepare($con, "INSERT INTO Rating ( ProductId, Rating, orderId)
						  VALUES (?,?,?)");
				$query->bind_param("iii", $productid, $rating, $id);

header("Location: ../../frontend/php/orderList.php");
	?>


  
  		
  
