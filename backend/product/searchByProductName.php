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



?>
