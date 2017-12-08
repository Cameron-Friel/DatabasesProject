<?php
	//this adds an item to the cart for the user to recieve
	include 'connectvarsEECS.php';

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}

	$itemID = $_POST['itemID'];
	$shoppingID = $_POST['shoppingID'];

	$query = "SELECT * FROM Purchased_item WHERE itemID = '$itemID' AND shoppingID = '$shoppingID'";

	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}

	if (mysqli_num_rows($result) == 0)
	{
		$query = "INSERT INTO Purchased_item (itemID, shoppingID, Quantity) VALUES ('$itemID','$shoppingID', 1);";
		mysqli_query($conn, $query);
	}
	else
	{
		$query = "UPDATE Purchased_item SET Quantity = Quantity + 1 WHERE itemID = '$itemID' AND shoppingID = '$shoppingID';";
		mysqli_query($conn, $query);
	}

	mysqli_free_result($result);
	mysqli_close($conn);
?>