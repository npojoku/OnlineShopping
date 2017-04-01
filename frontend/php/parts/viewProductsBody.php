<!-- Page Content -->
<?php if(isset($_GET['id']) && isset($_GET['type'])){
  $id = $_GET['id'];
  $type = $_GET['type'];
  if ($type == 1) {
  $sql = "SELECT p.ProductId, p.ProductDescription, p.ProductName, s.Type, s.Quantity, s.Price, AVG(r.Rating) AS Rating
  FROM Products p, Sells s, Rating r
  WHERE p.ProductId = s.ProductId AND s.ProductId = r.ProductId AND s.ProductId = $id AND s.Type = $type
  GROUP BY r.ProductId, s.Type";
} else {
  $sql = "SELECT p.ProductId, p.ProductDescription, p.ProductName, s.Type, s.Quantity, s.Price, q.name, AVG(r.Rating) AS Rating
  FROM Products p, Sells s, Rating r, Quality q
  WHERE p.ProductId = s.ProductId AND s.ProductId = r.ProductId AND s.QualityId = q.QualityId AND s.ProductId = $id AND s.Type = $type
  GROUP BY r.ProductId, s.Type";
}
  if ($result=mysqli_query($con,$sql)) {
      $data=mysqli_fetch_array($result, MYSQLI_ASSOC);
   }
 }
    ?>
<div class="container" style="width:65%">
        <div class="thumbnail" style="padding-left:30px;">

            <div class="caption-full">
                <h3 class="pull-right">$<?php echo "$data[Price]"; ?></h3>
                <h3><?php echo "&nbsp;&nbsp;$data[ProductName]"; ?>
                </h3>
                <hr>
                <p> <?php echo "&nbsp;&nbsp;Description: $data[ProductDescription]" ?> </p>
                 <p> <?php if ($data['Type'] == 0) {
                   echo "<p>&nbsp;&nbsp;Type: Used </p>";
                   echo "<p>&nbsp;&nbsp;Quality: $data[name] </p>";
                 } else {
                     echo "<p>&nbsp;&nbsp;Type: New </p>";
                 }
                 ?>
                <p> <?php echo "&nbsp;&nbsp;Quantity Available: $data[Quantity]" ?> </p>

                <div class="ratings">
                  <?php
                  if ($data['Rating'] == 0) {
                    echo "No one has rated this item yet!";
                  } else if ($data['Rating'] > 0 && $data['Rating'] <= 1) {
                    echo "<p>Rating: ";
                    echo "<span>";
                    echo '<span class="glyphicon glyphicon-star"></span>';
                    echo '<span class="glyphicon glyphicon-star-empty"></span>';
                    echo '<span class="glyphicon glyphicon-star-empty"></span>';
                    echo '<span class="glyphicon glyphicon-star-empty"></span>';
                    echo '<span class="glyphicon glyphicon-star-empty"></span>';
                    echo $data['Rating'];
                    echo '</p>';
                  } else if ($data['Rating'] > 1 && $data['Rating'] <= 2) {
                    echo "<p>Rating: ";
                    echo "<span>";
                    echo '<span class="glyphicon glyphicon-star"></span>';
                    echo '<span class="glyphicon glyphicon-star"></span>';
                    echo '<span class="glyphicon glyphicon-star-empty"></span>';
                    echo '<span class="glyphicon glyphicon-star-empty"></span>';
                    echo '<span class="glyphicon glyphicon-star-empty"></span>';
                    echo $data['Rating'];
                    echo '</p>';
                  } else if ($data['Rating'] > 2 && $data['Rating'] <= 3) {
                    echo "<p>Rating: ";
                    echo "<span>";
                    echo '<span class="glyphicon glyphicon-star"></span>';
                    echo '<span class="glyphicon glyphicon-star"></span>';
                    echo '<span class="glyphicon glyphicon-star"></span>';
                    echo '<span class="glyphicon glyphicon-star-empty"></span>';
                    echo '<span class="glyphicon glyphicon-star-empty"></span>';
                    echo $data['Rating'];
                    echo '</p>';
                  }else if ($data['Rating'] > 3 && $data['Rating'] <= 4) {
                    echo "<p>Rating: ";
                    echo "<span> ";
                    echo '<span class="glyphicon glyphicon-star"></span>';
                    echo '<span class="glyphicon glyphicon-star"></span>';
                    echo '<span class="glyphicon glyphicon-star"></span>';
                    echo '<span class="glyphicon glyphicon-star"></span>';
                    echo '<span class="glyphicon glyphicon-star-empty"></span>';
                    echo $data['Rating'];
                    echo '</p>';
                  }else if ($data['Rating'] > 4 && $data['Rating'] <= 5) {
                    echo "<p>Rating: ";
                    echo "<span>";
                    echo '<span class="glyphicon glyphicon-star"></span>';
                    echo '<span class="glyphicon glyphicon-star"></span>';
                    echo '<span class="glyphicon glyphicon-star"></span>';
                    echo '<span class="glyphicon glyphicon-star"></span>';
                    echo '<span class="glyphicon glyphicon-star"></span>';
                    echo $data['Rating'];
                    echo '</p>';
                  }
                  ?>

                </div>
                <hr>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php echo ("<a href='../php/checkOut.php?id=$id&type=$type'> <button type='button' class='btn btn-primary'>Order</button></a>"); ?>
            </div>

        </div>

    </div>

</div>
