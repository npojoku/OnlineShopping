<?php
require '../core.inc.php';
require '../session.php';

if (isset($_GET['ProductId']) && !empty($_GET['ProductId'])) {
	$ProductId = $_GET['ProductId'];
	$query = "SELECT ProductName, ProductDescription, COUNT(OrderId) AS NumRating, AVG(Rating) AS AverageRating FROM `Products`, Rating WHERE Products.ProductId = Rating.ProductId AND Products.ProductId = '$ProductId'";
	$result = mysqli_query($con, $query);
	$resultArray = array();
	while($r = mysqli_fetch_array($result)) {

		$one['ProductName']= $r['ProductName'];
		$one['ProductDescription'] = $r['ProductDescription'];
		$one['NumRating']= $r['NumRating'];
		$one['AverageRating']= $r['AverageRating'];

    	$resultArray[] = $one;
	}

	print json_encode($resultArray);

} else {
	header("Location: ../../frontend/php/error.php");
}

?>
