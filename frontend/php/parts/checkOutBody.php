<!-- Page Content -->
<?php if(isset($_GET['id']) && isset($_GET['type'])){
  $id = $_GET['id'];
  $type = $_GET['type'];
  $PersonId = getPersonId();
}

  $personQuery = "SELECT * FROM Person WHERE PersonId = $PersonId";

  $cardQuery = "SELECT * FROM CreditCard WHERE PersonId = $PersonId";

  if ($type == 1) {
  $productQuery = "SELECT p.ProductId, p.ProductDescription, p.ProductName, s.Type, s.Quantity, s.Price, s.ShopName, AVG(r.Rating) AS Rating
  FROM Products p, Sells s, Rating r
  WHERE p.ProductId = s.ProductId AND s.ProductId = r.ProductId AND s.ProductId = $id AND s.Type = $type
  GROUP BY r.ProductId, s.Type";
} else {
  $productQuery = "SELECT p.ProductId, p.ProductDescription, p.ProductName, s.Type, s.Quantity, s.Price, q.name, s.ShopName, AVG(r.Rating) AS Rating
  FROM Products p, Sells s, Rating r, Quality q
  WHERE p.ProductId = s.ProductId AND s.ProductId = r.ProductId AND s.QualityId = q.QualityId AND s.ProductId = $id AND s.Type = $type
  GROUP BY r.ProductId, s.Type";
}

  if ($result=mysqli_query($con,$personQuery)) {
      $person=mysqli_fetch_array($result, MYSQLI_ASSOC);
   }

   if ($result=mysqli_query($con,$productQuery)) {
       $product=mysqli_fetch_array($result, MYSQLI_ASSOC);
    }

    $msg = [];
    if(isset($_POST['confirmOrder'])){
        $card = $_POST['cardDdl'];
        $orderQty = $_POST['qtyName'];
        $orderPrice = $orderQty * $product['Price'];
        $status = 0;
        $valid = true;

        if ($product['Quantity'] < $orderQty) {
          $msg[] = '<div class="alert alert-danger" role="alert">You cannot order more than the quantity available!</div>';
           $valid = false;
        }

        if ($valid) {
        $query = mysqli_prepare($con, "INSERT INTO Orders (BuyerId, ShopName, ProductId, Quantity, Price, Type, OrderStatus, CreditCard)
              VALUES (?,?,?,?,?,?,?,?)");
        $query->bind_param("isiidiis", $PersonId, $product['ShopName'], $id, $orderQty, $orderPrice, $type, $status, $card);
        $query->execute();

        $msg[] = '<div class="alert alert-success" role="alert">Your order has been placed successfully!</div>';

        $updateQty = $product['Quantity'] - $orderQty;
        $updateQuery = "UPDATE Sells
              SET Quantity = $updateQty
              WHERE ProductId=$id AND Type = $type";

        $uQuery = mysqli_prepare($con, $updateQuery);
        $uQuery->execute();
    }
  }
    ?>
<div class="container" style="width:65%">
      <div class="thumbnail" style="padding-left:35px;">
            <div class="caption-full" style="height:740px ">
                <h3>Order Information </h3>
                <hr>
                <h4> Product Information </h4>
                <?php echo "<p><strong><font size=4 color=#428bca>$product[ProductName]</font></strong> <small> by $product[ShopName]</small> </p>";
                if ($product['Quantity'] > 0) {
                  echo "<p style='color:#5cb85c'>In Stock</p>";
                }
                echo "<p>Quantity Available: $product[Quantity]</p>";
                echo "<p id = 'price' style='display:none;'>$product[Price]</p>";
                echo "<p id = 'cQty' style='display:none;'>$product[Quantity]</p>";
                if ($product['Type'] == 0) {
                  echo "<p>Type: Used </p>";
                  echo "<p>Quality: $product[name] </p>";
                } else {
                    echo "<p>Type: New </p>";
                }
                echo "<p>Price: $$product[Price]</p>";
                ?>
                <br>
                <h4> Shipping Address </h4>
                <p> <?php echo "$person[Address]"; ?></p>
                <br>
                <form class="form-inline" action='checkOut.php<?php echo "?id=$id&type=$type"?>' method = 'post'>
                <h4> Select Credit Card </h4>
                <?php if ($result=mysqli_query($con,$cardQuery)) {
                    echo 'Credit Card #:&nbsp;&nbsp;';
                    echo '<select class="form-control" style="width:200px" name="cardDdl">';
                    while ($cardList=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo  "<option>";
                    echo "$cardList[CreditCard]</option>";
                  }
                    echo '</select>';
                 } ?>
                  <a href = '../php/profile.php'><button type='button' class='btn btn-default'>Add Card</button></a>
                 <br>
                 <br>
                 <h4> Select Quantity </h4>

                   Quantity: <input class="form-control" type="text" id="qty" name='qtyName' placeholder="Quantity">&nbsp;&nbsp;
                   <button type='button' id='qtyBtn' class='btn btn-default'>Update</button>

                   <hr>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <button type='submit' name='confirmOrder' class='btn btn-primary'>Confirm Order</button>
                   <h4 class="pull-right" id='total'>
                    </h4>
                    <br>
                    <?php foreach($msg as $m){
                       echo "$m";
                    }
                    ?>
              </form>
            </div>
        </div>

    </div>

</div>
