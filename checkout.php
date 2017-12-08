<?php
	//THIS FILE WILL BE CALLED WITH AJAX AND REMOVE ITEMS FROM CART
	include 'connectvarsEECS.php';

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}

	$itemID = $_POST['ItemID'];
	$shoppingID = $_POST['shoppingID'];

	$query = "INSERT INTO `Orders` (`OrderID`, `EmployeeID`, `ShopperID`, `ShoppingID`, `Total`, `Shopper_signature`, `Picker_signature`) VALUES ('4', NULL, '2', '2', '0', '0', '0');";

	mysqli_query($conn, $query);

	mysqli_free_result($result);
	mysqli_close($conn);
?>