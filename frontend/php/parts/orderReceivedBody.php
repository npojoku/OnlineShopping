
<div class="container">
<div class="col-md-11">
  <h3>Manage Orders</h3>
  <br>
  <div class="row">

  <!-- search bar -->
  <form action = "../php/orderReceived.php" method = "get">
  <div class="col-sm-5">
    <div class="input-group">
      <input  type="text" class="form-control" name="OrderId" placeholder="Search Order Id">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Go!</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  </form>
  <form action = "../php/orderReceived.php" method = "get" id="report_filter">

  <!-- sort drop down -->
  <div class="col-sm-5">
    <div class="input-group">
      <select name="filter" class="form-control" onchange="document.getElementById('report_filter').submit();"
      style="bottom: 15px;">
        <option value="0">Filter/Order by</option>
        <option value="3" <?php if(isset($_GET["filter"]) && htmlspecialchars($_GET["filter"])=='3') echo "selected";?>>Most Recent Orders</option>
        <option value="4" <?php if(isset($_GET["filter"]) && htmlspecialchars($_GET["filter"])=='4') echo "selected";?>>Oldest Orders</option>
        <option value="1" <?php if(isset($_GET["filter"]) && htmlspecialchars($_GET["filter"])=='1') echo "selected";?>>Finished Orders</option>
        <option value="2" <?php if(isset($_GET["filter"]) && htmlspecialchars($_GET["filter"])=='2') echo "selected";?>>Unfinished Orders</option>
      </select>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</form>
</div>


<br>
<table class="table table-hover">
  <tr>
  <th> Purchase Time</th>
  <th> Product </th>
  <th> Quantity </th>
  <th> Price </th>
  <th> First Name </th>
	<th> Last Name </th>
	<th> Phone </th>
	<th> Address </th>
	<th> Finished </th>
  </tr>
<?php

    $PersonId = getPersonId();

    $sql0 = "SELECT ShopName FROM Retailers WHERE PersonId=$PersonId";
    $result0=mysqli_query($con,$sql0);
    $row0=mysqli_fetch_array($result0, MYSQLI_ASSOC);
    $ShopName = $row0["ShopName"];

    $sql="SELECT o.OrderId, p.FirstName,p.LastName,p.Phone,p.Address,pd.ProductName,o.Quantity,o.Price,o.OrderStatus,o.TIMESTAMP
          FROM Orders o, Person p, Products pd
          WHERE o.BuyerId = p.PersonId AND o.ShopName LIKE '$ShopName' AND pd.ProductId = o.ProductId
	        GROUP BY o.OrderId, o.OrderStatus";




if (isset($_GET["OrderId"])) {
  $name = $_GET["OrderId"];

    $sql="SELECT o.OrderId, p.FirstName,p.LastName,p.Phone,p.Address,pd.ProductName,o.Quantity,o.Price,o.OrderStatus,o.TIMESTAMP
          FROM Orders o, Person p, Products pd
          WHERE o.BuyerId = p.PersonId AND o.ShopName LIKE '$ShopName' AND pd.ProductId = o.ProductId AND o.OrderId ='$name'
          GROUP BY o.OrderId, o.OrderStatus";




} else if(isset($_GET["filter"])) {
   if ($_GET["filter"] == 1) {
    $sql="SELECT o.OrderId, p.FirstName,p.LastName,p.Phone,p.Address,pd.ProductName,o.Quantity,o.Price,o.OrderStatus,o.TIMESTAMP
          FROM Orders o, Person p, Products pd
          WHERE o.BuyerId = p.PersonId AND o.ShopName LIKE '$ShopName' AND pd.ProductId = o.ProductId AND o.OrderStatus = 1
	         GROUP BY OrderId, o.OrderStatus";

   } else if ($_GET["filter"] == 2) {
     $sql="SELECT o.OrderId, p.FirstName,p.LastName,p.Phone,p.Address,pd.ProductName,o.Quantity,o.Price,o.OrderStatus,o.TIMESTAMP
          FROM Orders o, Person p, Products pd
          WHERE o.BuyerId = p.PersonId AND o.ShopName LIKE '$ShopName' AND pd.ProductId = o.ProductId AND o.OrderStatus = 0
           GROUP BY OrderId, o.OrderStatus";

   }else if ($_GET["filter"] == 3) {
      $sql="SELECT o.OrderId, p.FirstName,p.LastName,p.Phone,p.Address,pd.ProductName,o.Quantity,o.Price,o.OrderStatus,o.TIMESTAMP
          FROM Orders o, Person p, Products pd
          WHERE o.BuyerId = p.PersonId AND o.ShopName LIKE '$ShopName' AND pd.ProductId = o.ProductId
	   GROUP BY OrderId, o.OrderStatus
     ORDER BY o.TIMESTAMP desc" ;
   }else if ($_GET["filter"] == 4) {
      $sql="SELECT o.OrderId, p.FirstName,p.LastName,p.Phone,p.Address,pd.ProductName,o.Quantity,o.Price,o.OrderStatus,o.TIMESTAMP
          FROM Orders o, Person p, Products pd
          WHERE o.BuyerId = p.PersonId AND o.ShopName LIKE '$ShopName' AND pd.ProductId = o.ProductId
	GROUP BY OrderId, o.OrderStatus
     ORDER BY o.TIMESTAMP";
   }
}

if ($result=mysqli_query($con,$sql))
  {
  while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {

  echo ("
    <td>$row[TIMESTAMP] </td>
    <td>$row[ProductName] </td>
    <td>$row[Quantity] </td>
    <td>$row[Price] </td>
    <td>$row[FirstName] </td>
    <td>$row[LastName] </td>
  	<td>$row[Phone] </td>
  	<td>$row[Address] </td>
	");

  // create form to update order status
  echo "<td>";
    echo "<form action='orderReceived.php' method='post'>";

      // hidden order id input
      $OrderId = $row['OrderId'];
      echo "<input style='display:none' type='text' name='OrderId' value='$OrderId'>";

      echo "<input type='checkbox' name='isFinished' onChange='this.form.submit()' ";

      // check and disable box if order has been completed
      if ($row['OrderStatus']) {echo "disabled='disabled' checked";}
      echo ">";

    echo "</form>";
  echo "</td>";

  echo "</tr>";
}
  // Free result set
  //mysqli_free_result($result);
}
 ?>
 </table>
 </div>
 </div>
