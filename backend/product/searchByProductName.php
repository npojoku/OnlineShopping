<?php
require '../core.inc.php';
require '../session.php';
/*
Path: ---------------------------

Description: search product by its Name or description if searchText empty, view all
Input:
		$_GET
			'searchText'		(String) 
Output
		json array:
			[ProductId]				ProductId
			[ProductName]			ProductName
			[ImageURL]				Product image url
			[UsedQuanity]			UsedQuanity
			[NewQuanity]			NewQuanity
			[AverageRating]			Average rating for the product
			[NewPrice]				NewPrice
			[UsedPrice]				UsedPrice

Error:
	0						failed
	-1						no session
	-2						field must not be empty/null
	--						----------
	--						----------
	--						----------
	--						----------
	-7						required field not set
*/

if (isset($_GET['searchText']) && !empty($_GET['searchText'])) {
	$searchText = $_GET['searchText'];
	
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
