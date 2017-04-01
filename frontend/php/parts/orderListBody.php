
<div class="container">
<div class="col-md-10">
  <h3> Orders Placed </h3>
  <br>
  <div class="row">
  <form action = "../php/orderList.php" method = "get">
  <div class="col-sm-5">
    <div class="input-group">
      <input  type="text" class="form-control" name="OrderId" placeholder="Search Order Id">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Go!</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  </form>
  <form action = "../php/orderList.php" method = "get" id="report_filter">
  <div class="col-sm-5">
    <div class="input-group">
      <select name="filter" class="form-control" onchange="document.getElementById('report_filter').submit();"
      style="bottom: 15px;">
        <option value="0">Filter/Order by</option>
        <option value="3" <?php if(isset($_GET["filter"]) && htmlspecialchars($_GET["filter"])=='3') echo "selected";?>>Most Recent Orders</option>
        <option value="4" <?php if(isset($_GET["filter"]) && htmlspecialchars($_GET["filter"])=='4') echo "selected";?>>Oldest Orders</option>
        <option value="1" <?php if(isset($_GET["filter"]) && htmlspecialchars($_GET["filter"])=='1') echo "selected";?>>Completed Orders</option>
        <option value="2" <?php if(isset($_GET["filter"]) && htmlspecialchars($_GET["filter"])=='2') echo "selected";?>>Pending Orders</option>
      </select>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</form>
</div>
<br>
<table class="table table-hover">
  <tr>
    <th> Order Id </th>
    <th> Purchase Time</th>
    <th> Product </th>
    <th> Quantity </th>
    <th> Price </th>
    <th> Shop Name </th>
  	<th> Phone </th>
  	<th> Finished </th>
    <th> </th>
  </tr>
<?php

    $PersonId = getPersonId();
    $sql="SELECT OrderId, FirstName,LastName,Phone,ShopName,ProductName,Quantity,Price,o.OrderStatus,o.TIMESTAMP
	FROM Orders o, Person p, Products pd
	WHERE o.BuyerId = p.PersonId && o.ProductId = pd.ProductId && p.PersonId = $PersonId
	GROUP BY o.OrderId, o.OrderStatus";




if (isset($_GET["OrderId"])) {
  $name = $_GET["OrderId"];

    $sql="SELECT OrderId, FirstName,LastName,Phone,ShopName,ProductName,Quantity,Price,o.OrderStatus,o.TIMESTAMP
	FROM Orders o, Person p, Products pd
	WHERE o.BuyerId = p.PersonId && o.ProductId = pd.ProductId && OrderId LIKE '%$name%' && p.PersonId = $PersonId
	GROUP BY o.OrderId, o.OrderStatus";




} else if(isset($_GET["filter"])) {
   if ($_GET["filter"] == 1) {
    $sql="SELECT OrderId, FirstName,LastName,Phone,ShopName,ProductName,Quantity,Price,o.OrderStatus,o.TIMESTAMP
	FROM Orders o, Person p, Products pd
	WHERE o.BuyerId = p.PersonId && o.ProductId = pd.ProductId && o.OrderStatus = 1 && p.PersonId = $PersonId
	GROUP BY OrderId, o.OrderStatus";

   } else if ($_GET["filter"] == 2) {
     $sql="SELECT OrderId, FirstName,LastName,Phone,ShopName,ProductName,Quantity,Price,o.OrderStatus,o.TIMESTAMP
	FROM Orders o, Person p, Products pd
	WHERE o.BuyerId = p.PersonId && o.ProductId = pd.ProductId && o.OrderStatus = 0 && p.PersonId = $PersonId
	GROUP BY OrderId, o.OrderStatus";

   }else if ($_GET["filter"] == 3) {
      $sql="SELECT OrderId, FirstName,LastName,Phone,ShopName,ProductName,Quantity,Price,o.OrderStatus,o.TIMESTAMP
	FROM Orders o, Person p, Products pd
	WHERE o.BuyerId = p.PersonId && o.ProductId = pd.ProductId  && p.PersonId = $PersonId
	GROUP BY OrderId, o.OrderStatus
     ORDER BY o.TIMESTAMP desc" ;
   }else if ($_GET["filter"] == 4) {
      $sql="SELECT OrderId, FirstName,LastName,Phone,ShopName,ProductName,Quantity,Price,o.OrderStatus,o.TIMESTAMP
	FROM Orders o, Person p, Products pd
	WHERE o.BuyerId = p.PersonId && o.ProductId = pd.ProductId && p.PersonId = $PersonId
	GROUP BY OrderId, o.OrderStatus
     ORDER BY o.TIMESTAMP";
   }
}

if ($result=mysqli_query($con,$sql))
  {
  while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  echo ("<tr><td>$row[OrderId]</td>");
  echo "<td>$row[TIMESTAMP] </td>";
  echo ("
  <td>$row[ProductName] </td>
  <td>$row[Quantity] </td>
  <td>$row[Price] </td>
    <td>$row[ShopName] </td>
	<td>$row[Phone] </td>

	");

	 if ($row['OrderStatus'] == 0) {
    echo "<td> Pending </td>";
  } else {
    echo "<td> Complete </td>";
  }

  echo "<td> <a href='../php/rate.php?id=$row[OrderId]'> <button type='button' class='btn btn-primary'";
  if ($row['OrderStatus']==0) {echo "disabled='disabled'>Rate</button></td>"; }
 else {echo "'>Rate</button></a></td>"; }
  echo "</tr>";
}
  // Free result set
  //mysqli_free_result($result);
}
 ?>
 </table>
 </div>
 </div>
