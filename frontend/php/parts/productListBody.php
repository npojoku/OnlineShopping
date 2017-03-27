<div class="container">
<div class="col-md-7 col-md-offset-2">
  <h3> Product List </h3>
  <br>
  <div class="row">
  <form action = "../php/productList.php" method = "get">
  <div class="col-sm-5">
    <div class="input-group">
      <input  type="text" class="form-control" name="ProductName" placeholder="Search Item Name">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Go!</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  </form>
  <form action = "../php/productList.php" method = "get" id="report_filter">
  <div class="col-sm-5">
    <div class="input-group">
      <select name="filter" class="form-control" onchange="document.getElementById('report_filter').submit();"
      style="bottom: 15px;">
        <option value="0">Filter by</option>
        <option value="1" <?php if(isset($_GET["filter"]) && htmlspecialchars($_GET["filter"])=='1') echo "selected";?>>Price: Highest to Lowest</option>
        <option value="2" <?php if(isset($_GET["filter"]) && htmlspecialchars($_GET["filter"])=='2') echo "selected";?>>Price: Lowest to Highest</option>
        <option value="3" <?php if(isset($_GET["filter"]) && htmlspecialchars($_GET["filter"])=='3') echo "selected";?>>Rating: Highest to Lowest</option>
        <option value="4" <?php if(isset($_GET["filter"]) && htmlspecialchars($_GET["filter"])=='4') echo "selected";?>>Rating: Lowest to Highest</option>
      </select>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</form>
</div>
<br>
<table class="table table-hover">
  <tr>
    <th> Name </th>
    <th> Price </th>
    <th> Rating </th>
    <th> Quantity </th>
  </tr>
<?php

  $sql="SELECT ProductName,Quantity,Rating,Price
  FROM Products p, Sells s, Rating r
  WHERE p.ProductId = s.ProductId && s.ProductId = r.ProductId";

if (isset($_GET["ProductName"])) {
  $name = $_GET["ProductName"];
  $sql="SELECT ProductName,Quantity,Rating,Price
  FROM Products p, Sells s, Rating r
  WHERE p.ProductId = s.ProductId && s.ProductId = r.ProductId && p.ProductName LIKE '%$name%'";
} else if(isset($_GET["filter"])) {
   if ($_GET["filter"] == 1) {
     $sql="SELECT ProductName,Quantity,Rating,Price
     FROM Products p, Sells s, Rating r
     WHERE p.ProductId = s.ProductId && s.ProductId = r.ProductId
     ORDER BY s.Price desc";
   } else if ($_GET["filter"] == 2) {
     $sql="SELECT ProductName,Quantity,Rating,Price
     FROM Products p, Sells s, Rating r
     WHERE p.ProductId = s.ProductId && s.ProductId = r.ProductId
     ORDER BY s.Price";
   }else if ($_GET["filter"] == 3) {
     $sql="SELECT ProductName,Quantity,Rating,Price
     FROM Products p, Sells s, Rating r
     WHERE p.ProductId = s.ProductId && s.ProductId = r.ProductId
     ORDER BY r.Rating desc";
   }else if ($_GET["filter"] == 4) {
     $sql="SELECT ProductName,Quantity,Rating,Price
     FROM Products p, Sells s, Rating r
     WHERE p.ProductId = s.ProductId && s.ProductId = r.ProductId
     ORDER BY r.Rating";
   }
}

if ($result=mysqli_query($con,$sql))
  {
  while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
  echo ("
  <tr>
  <td><a href='#'> $row[ProductName] </a></td>
  <td>$row[Price]</td>
  <td>$row[Rating]</td>
  <td>$row[Quantity]</td>
  </tr>");
  // Free result set
  mysqli_free_result($result);
}
 ?>
 </table>
 </div>
 </div>
