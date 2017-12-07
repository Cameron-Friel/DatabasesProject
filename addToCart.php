<?php

	include 'connectvarsEECS.php';

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}

	$name = $_POST['Name'];
	$shoppingID = $_POST['shoppingID'];

	$query = "SELECT itemID FROM Grocery_item WHERE name = '$name'";


	$result = mysqli_query($conn, $query);
	if (!$result) {
	die("Error!");
	}

	$itemIDs = array();

	while ($itemID = mysqli_fetch_assoc($result))
	{
	  $itemIDs[] = $itemID;
	}

	$query = "INSERT INTO Purchased_item (itemID, shoppingID, Quantity) VALUES ('".$itemIDs[0]['itemID']."','$shoppingID', 1)";

	mysqli_query($conn, $query);

	mysqli_free_result($result);
	mysqli_close($conn);
?>