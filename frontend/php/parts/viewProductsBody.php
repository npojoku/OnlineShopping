<!-- Page Content -->
<?php if(isset($_GET['view'])){
  $id = $_GET['view'];
  $sql = "SELECT *
  FROM Products p, Sells s, Rating r
  WHERE p.ProductId = s.ProductId && s.ProductId = r.ProductId && p.ProductId = '$id'";
  if ($result=mysqli_query($con,$sql)) {
      $data=mysqli_fetch_array($result, MYSQLI_ASSOC);
   }
 }
    ?>
<div class="container">

              <div class="col-md-7 col-md-offset-2">

                  <h3><?php   echo "$data[ProductName]"; ?></h3>
                  <br>
                  <p> <?php echo "Description: $data[ProductDescription]" ?> </p>
                  <p> <?php echo "Rating: $data[Rating]" ?>
              </div>

</div>
