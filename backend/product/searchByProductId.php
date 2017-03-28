<?php
require '../core.inc.php';
require '../session.php';
/*
Path: backend/product/searchByProductId.php

Description: search product by its product Id

Input:
		$_GET
			'ProductId'		(int) 
			
Output
		json array:
			[ProductName]			ProductName
			[ProductDescription]			ProductDescription
			[NumRating]				number of ratings
			[AverageRating]			average ratings for this product

		
Error:
	0						failed
	-1						no session
	-7						required field not set
*/

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
	echo "-7";
}

?>
