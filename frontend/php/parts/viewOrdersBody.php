<!-- Page Content -->
<?php if(isset($_GET['id']) && isset($_GET['status'])){
  $id = $_GET['id'];
  $status = $_GET['status'];
  $sql = "SELECT OrderId, FirstName,LastName,Phone,ShopName,ProductName,Quantity,Price,o.OrderStatus,o.TIMESTAMP
  FROM Orders o, Person p, Products pd
  WHERE o.BuyerId = p.PersonId && o.ProductId = pd.ProductId && o.OrderId = $id && o.OrderStatus = $status
  GROUP BY o.OrderId, o.OrderStatus";
  if ($result=mysqli_query($con,$sql)) {
      $data=mysqli_fetch_array($result, MYSQLI_ASSOC);
   }
 }
    ?>
<div class="container" style="width:65%">



        <div class="thumbnail">

            <div class="caption-full">
                <h3 class="pull-right"><?php echo "ProductName:$data[ProductName]"; ?></h3>
                <h3><?php echo "OrderId:$data[OrderId]"; ?>
                </h3>
                <hr>
          
                 <p> <?php if ($data['OrderStatus'] == 0) {
                   echo "<p>&nbsp;&nbsp;OrderStatus: NotFinished </p>";
                 } else {
                     echo "<p>&nbsp;&nbsp;OrderStatus: Finished </p>";
                 }
                 ?>
                <p> <?php echo "&nbsp;&nbsp;FirstName: $data[FirstName]" ?> </p>
				<p> <?php echo "&nbsp;&nbsp;LastName: $data[LastName]" ?> </p>
				<p> <?php echo "&nbsp;&nbsp;PhoneNumber: $data[Phone]" ?> </p>
			
				<p> <?php echo "&nbsp;&nbsp;ShopName: $data[ShopName]" ?> </p>
               
                <hr>
                <button type="button" class="btn btn-primary">Rating</button>

            </div>

        </div>

    </div>

</div>
