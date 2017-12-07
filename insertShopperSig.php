<!DOCTYPE html>

<html>
	<head>
		<title>Home Page</title>
		<link rel="stylesheet" href="style.css">

		<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
	</head>

  <body>
		<?php

		   include 'connectvarsEECS.php';

		   $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		   if (!$conn) {
				die('Could not connect: ' . mysql_error());
		    }

      $shopperSignature = $_POST['signature'];
      $order = $_POST['order'];
			$emp = $_POST['employee'];

      $query = "UPDATE Orders SET Shopper_signature='$shopperSignature' WHERE OrderID='$order'";

      mysqli_query($conn, $query);

			$query = "UPDATE Orders SET ShopperID='$emp' WHERE OrderID = '$order'";

			mysqli_query($conn, $query);

			mysqli_free_result($result);
			mysqli_close($conn);
		 ?>
  </body>

	<script
 src="https://code.jquery.com/jquery-3.2.1.min.js"
 integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
 crossorigin="anonymous"></script>

</html>
