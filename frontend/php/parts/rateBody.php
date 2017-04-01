
<?php if(isset($_GET['id'])){
  $orderid = $_GET['id'];
  $PersonId = getPersonId();
  $getProductId = "SELECT * FROM Orders WHERE BuyerId = $PersonId AND OrderId = $orderid";



  if ($result=mysqli_query($con,$getProductId)) {
      $productId = mysqli_fetch_array($result, MYSQLI_ASSOC);
   }

     $productDataQuery = "SELECT * FROM Products WHERE ProductId = $productId[ProductId]";

   if ($result=mysqli_query($con,$productDataQuery)) {
       $productData = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
    $msg = [];
if(isset($_POST['confirmRate'])){
  $valid = true;
  $rateValue = $_POST['rating'];
  if ($rateValue > 5 || $rateValue < 0) {
    $msg[] = '<div class="alert alert-danger" role="alert">Rating must be between 0 or 5!</div>';
     $valid = false;
  } else if (!ctype_digit($rateValue)) {
    $msg[] = '<div class="alert alert-danger" role="alert">Please only input integer!</div>';
     $valid = false;
  }
    if ($valid) {
      $sql1 = "DELETE FROM Rating WHERE ProductId = $productId['ProductId'] AND OrderId =0 AND Rating = 0";
      $query1 = mysqli_prepare($con, $sql1);
      $query1->execute();
      
      $query = mysqli_prepare($con, "INSERT INTO Rating (ProductId, Rating, OrderId)
            VALUES (?,?,?)");
      $query->bind_param("iii", $productId['ProductId'], $rateValue, $orderid);
      $query->execute();
        $msg[] = '<div class="alert alert-success" role="alert">Thanks for rating!</div>';
    }
  }
}

  //$query = mysqli_prepare($con, "INSERT INTO Rating ( ProductId, Rating, orderId)
	//					  VALUES (?,?,?)");
		//		$query->bind_param("iii", $productid, $rating, $id);

	?>

  <div class="container" style="width:65%">


          <div class="thumbnail" style="padding-left:30px;">

              <div class="caption-full">
                <h4> Your are rating <?php echo "$productData[ProductName]"; ?> <small> by
                <?php echo "$productId[ShopName]"; ?> </small>  </h4>
                <hr>
                <form class="form-inline" action='rate.php<?php echo "?id=$orderid"?>' method = 'post'>
                   <div class="form-group">
                     <label class="col-sm-5 control-label">Give Rating: </label>
                     <div class="col-sm-7">
                       <input type="text" class="form-control" name="rating" placeholder="Specify Your Rating">
                     </div>
                   </div>
                        &nbsp;&nbsp;<button type='submit' name='confirmRate' class='btn btn-primary'>Rate</button>
                 </form>
                 <?php foreach($msg as $m){
                    echo "$m";
                 } ?>
              </div>

          </div>

</div>
