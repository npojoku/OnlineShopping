<!-- Page Content -->
<?php if(isset($_GET['id']) && isset($_GET['type'])){
  $id = $_GET['id'];
  $type = $_GET['type'];
  $sql = "SELECT p.ProductId, p.ProductDescription, p.ProductName, s.Type, s.Quantity, s.Price, AVG(r.Rating) AS Rating
  FROM Products p, Sells s, Rating r
  WHERE p.ProductId = s.ProductId AND s.ProductId = r.ProductId AND s.ProductId = $id AND s.Type = $type
  GROUP BY r.ProductId, s.Type";
  if ($result=mysqli_query($con,$sql)) {
      $data=mysqli_fetch_array($result, MYSQLI_ASSOC);
   }
 }
    ?>
<div class="container">

              <div class="col-md-7 col-md-offset-2">

                  <h3><?php echo "$data[ProductName]"; ?></h3>
                  <br>
                  <p> <?php echo "Description: $data[ProductDescription]" ?> </p>
                  <p> <?php if ($data['Type'] == 0) {
                    echo "<p> Type: Used </p>";
                  } else {
                      echo "<p> Type: New </p>";
                  }
                  ?>
                  <p> <?php echo "Rating: $data[Rating]" ?>
              </div>

</div>
