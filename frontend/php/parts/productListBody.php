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
        <option value="5" <?php if(isset($_GET["filter"]) && htmlspecialchars($_GET["filter"])=='5') echo "selected";?>>Only Highest Rating</option>
      </select>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</form>
<?php
$popularItemQuery = "SELECT ProductName FROM Products p
WHERE NOT EXISTS (SELECT * FROM Person p WHERE NOT EXISTS
  (SELECT * FROM Orders o WHERE o.ProductId = p.ProductId AND o.BuyerId = p.PersonId))";

  if ($result=mysqli_query($con,$popularItemQuery)) {
      $popularItem=mysqli_fetch_array($result, MYSQLI_ASSOC);
   }
?>
<br>
<br>
 <?php
 if ($popularItem['ProductName'] != null) {
   echo "<p>&nbsp;&nbsp;&nbsp; <span class='glyphicon glyphicon-star' aria-hidden='true'>
   </span> Most popular item:<strong> $popularItem[ProductName]</strong></p>";
 }
 ?>
</div>
<br>
<table class="table table-hover">
  <tr>
    <th> Name </th>
    <th> Type </th>
    <th> Price </th>
    <th> Quantity </th>
    <th> Rating </th>
  </tr>
<?php

  $sql="SELECT p.ProductId, p.ProductName, s.Type, s.Quantity, s.Price, AVG(r.Rating) AS Rating
  FROM Products p, Sells s, Rating r
  WHERE p.ProductId = s.ProductId AND s.ProductId = r.ProductId AND s.Quantity > 0
  GROUP BY r.ProductId, s.Type";

if (isset($_GET["ProductName"])) {
  $name = $_GET["ProductName"];
  $sql="SELECT p.ProductId, p.ProductName, s.Type, s.Quantity, s.Price, AVG(r.Rating) AS Rating
  FROM Products p, Sells s, Rating r
  WHERE p.ProductId = s.ProductId AND s.ProductId = r.ProductId  AND p.ProductName LIKE '%$name%' AND s.Quantity > 0
  GROUP BY r.ProductId, s.Type";
} else if(isset($_GET["filter"])) {
   if ($_GET["filter"] == 1) {
     $sql="SELECT p.ProductId, p.ProductName, s.Type, s.Quantity, s.Price, AVG(r.Rating) AS Rating
     FROM Products p, Sells s, Rating r
     WHERE p.ProductId = s.ProductId && s.ProductId = r.ProductId AND s.Quantity > 0
     GROUP BY r.ProductId, s.Type
      ORDER BY s.Price desc";

   } else if ($_GET["filter"] == 2) {
     $sql="SELECT p.ProductId, p.ProductName, s.Type, s.Quantity, s.Price, AVG(r.Rating) AS Rating
     FROM Products p, Sells s, Rating r
     WHERE p.ProductId = s.ProductId && s.ProductId = r.ProductId AND s.Quantity > 0
     GROUP BY r.ProductId, s.Type
     ORDER BY s.Price";
   }else if ($_GET["filter"] == 3) {
     $sql="SELECT p.ProductId, p.ProductName, s.Type, s.Quantity, s.Price, AVG(r.Rating) AS Rating
     FROM Products p, Sells s, Rating r
     WHERE p.ProductId = s.ProductId && s.ProductId = r.ProductId AND s.Quantity > 0
     GROUP BY r.ProductId, s.Type
     ORDER BY Rating desc";
   }else if ($_GET["filter"] == 4) {
     $sql="SELECT p.ProductId, p.ProductName, s.Type, s.Quantity, s.Price, AVG(r.Rating) AS Rating
     FROM Products p, Sells s, Rating r
     WHERE p.ProductId = s.ProductId && s.ProductId = r.ProductId AND s.Quantity > 0
     GROUP BY r.ProductId, s.Type
     ORDER BY Rating";
   }else if ($_GET["filter"] == 5) {
     $sql="SELECT p.ProductId, p.ProductName, s.Type, SUM(s.Quantity) AS Quantity, s.Price, rat2.max_avg AS Rating
     FROM Products p, Sells s,
     (SELECT r.ProductId, AVG(r.Rating) AS avg_rat FROM Rating r GROUP BY ProductId) rat,
     (SELECT MAX(rat1.avg_rat) AS max_avg FROM (SELECT r.ProductId, AVG(r.Rating) AS avg_rat FROM Rating r GROUP BY ProductId) rat1) rat2
     WHERE rat.ProductId = p.ProductId AND rat.avg_rat = rat2.max_avg AND s.ProductId = p.ProductId AND s.Quantity > 0
     GROUP BY rat.ProductId, s.type
     ";
   }
}

if ($result=mysqli_query($con,$sql))
  {
  while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  echo ("
  <tr>
  <td><a href='../php/viewProducts.php?id=$row[ProductId]&type=$row[Type]'> $row[ProductName] </a></td> ");
  if ($row['Type'] == 0) {
    echo "<td> Used </td>";
  } else {
    echo "<td> New </td>";
  }
  echo "<td>$row[Price]</td>";
  echo "<td>$row[Quantity]</td>";
  if ($row['Rating'] > 0) {
    echo "<td>$row[Rating]</td>";
  } else {
    echo "<td> </td>";
  }

  echo "</tr>";
}
  // Free result set
  //mysqli_free_result($result);
}
 ?>
 </table>
 </div>
 </div>
