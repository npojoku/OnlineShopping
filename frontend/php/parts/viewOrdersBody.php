<!-- Page Content -->
<?php if(isset($_GET['id']) && isset($_GET['status'])){
	$PersonId = getPersonId();
  $id = $_GET['id'];
  $status = $_GET['status'];
  $sql="SELECT o.OrderId, FirstName,LastName,Phone,ShopName,ProductName,Quantity,Price,o.OrderStatus,o.TIMESTAMP
 FROM Orders o, Person p, Products pd
  WHERE o.BuyerId = p.PersonId && o.ProductId = pd.ProductId && p.PersonId = $PersonId && o.OrderId = $id && o.OrderStatus = $status
  GROUP BY o.OrderId, o.OrderStatus";
 ;
  if ($result=mysqli_query($con,$sql)) {
      $data=mysqli_fetch_array($result, MYSQLI_ASSOC);
   }
 }



    ?>
<div class="container" style="width:65%">

        <div class="thumbnail" style="padding-left:30px;">

            <div class="caption-full">

			<h3><?php echo "OrderId: $data[OrderId]"; ?></h3>


                <hr>
								<p> <?php echo "&nbsp;&nbsp;ProductName: $data[ProductName]"; ?> </p>
                 <p> <?php if ($data['OrderStatus'] == 0) {
                   echo "<p>&nbsp;&nbsp;Order Status: Pending </p>";
                 } else {
                     echo "<p>&nbsp;&nbsp;Order Status: Complete </p>";
                 }
                 ?>

				<p> <?php echo "&nbsp;&nbsp;Customer Name: $data[FirstName] $data[LastName]" ?> </p>
				<p> <?php echo "&nbsp;&nbsp;Quantity: $data[Quantity]" ?> </p>
				<p> <?php echo "&nbsp;&nbsp;Price: $data[Price]" ?> </p>
				<p> <?php echo "&nbsp;&nbsp;Shop Name: $data[ShopName]" ?> </p>

                <hr>
				
				<div class="rating">
						Rate for this order!
						<?php foreach(range(1,5) as $rating):?>
						<a href="../php/rate.php?orderid=<?php echo $id;?>&rating=<?php echo $rating;?>"><?php echo $rating; ?></a>
						<?php endforeach;?>
				</div>
     
            </div>

        </div>

    </div>

</div>
