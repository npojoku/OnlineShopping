<?php
	/* add retailer permissions to current user */

function addRetailer($con, $ShopName, $DepositAccount){
	$PersonId = getPersonId();

	$sql = "INSERT INTO Retailers (PersonId, ShopName, DepositAccount)
						VALUES ('$PersonId','$ShopName','$DepositAccount')";

	$query = mysqli_prepare($con, $sql);

	if($query->execute()){
		// set session user type
		setUserType();

		return true;
	}
	return false;
}

 ?>
