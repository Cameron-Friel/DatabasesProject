<!DOCTYPE html>

<head>

  <title> Inventory </title>

  <meta charset="utf-8">
  
  <link rel="icon" href="https://image.flaticon.com/icons/png/512/2/2772.png">

  <link type="text/css" rel="stylesheet" href="style.css" media = "screen">

  <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">

</head>



<header>

	 <h2 class = "site-title"> Food United<a class = "site-signin" href="newShopper.php">Sign Up</a>
	 <a class = "site-signin" href = "shopperLogin.php">Login</a><a class = "site-logout" href = "logout.php">Logout</a></h2>

	 <ul class="navlist">
		<li class="navitem"><a href="home.php">Home</a></li>
			<li class="navitem"><a href="about.php">About</a></li>
			<li class="navitem-both"><a href="itemList.php">Products</a></li>
			<li class="navitem-shopper"><a href="shoppingCart.php">Cart</a></li>
			<li class="navitem-shopper"><a href="shopperHistory.php">History</a></li>
			<li class="navitem-picker"><a href="pickerAccount.php">Orders</a></li>
			<li class="navitem-picker"><a href="pickerHistory.php">History</a></li>
	 </ul>

	 </header>

<footer>
 <div class="pageFooter">
   <p class="footerText">Created By:</p>
   <p class="footerText">Cameron Friel and Zach Tusing</p>
   <p class="footerText"><a href = "https://www.twitch.tv/connor75">CONNOR75</a></p>
 </div>
</footer>

<body>
<div id="tableZT">
    <?php

    session_start();

	include 'connectvarsEECS.php';

    	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
// Retrieve name of table selected
	//$table = $_POST['Grocery_item'];

	$query = "SELECT max(shoppingID) FROM Shopping_cart where ShopperID = '".$_SESSION['id']."'";

  //echo $query;

  $result = mysqli_query($conn, $query);
  if (!$result) {
    die("You are not Logged in!");
  }

  $shoppingIDS = array();

	while ($shoppingID = mysqli_fetch_assoc($result))
	{
		$shoppingIDS[] = $shoppingID;
	}


	$query = "SELECT Name,Info,Calories,Price,Image FROM Grocery_item ";

	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
	$fields_num = mysqli_num_fields($result);
	echo "<table border='0'><tr>";

// printing table headers
	for($i=0; $i<$fields_num; $i++) {
		$field = mysqli_fetch_field($result);
		echo "<td><b>$field->name</b></td>";
	}
	echo "</tr>\n";
	//echo "<th> Accept</th>";
	while($row = mysqli_fetch_array($result)) {
    echo "<tbody data-link='row' class='rowlink'>";
    echo "<tr>";
    echo "<td class = 'name'>" . $row['Info'] . "</td>";
    echo "<td>" . $row['Info'] . "</td>";
    echo "<td>" . $row['Calories'] . "</td>";
    echo "<td>" . $row['Price'] . "</td>";
    echo "<td><img src ='" . $row['Image'] . "'></img></td>";
    echo "<form action ='removeCart.php' type='post'>";
    echo "<input type = 'text' name = 'name' value = '".$row['Name']."' class = 'nameZT' style = 'display:none'>";
    echo "<input type = 'text' name = 'shoppingID' value = '".$shoppingIDS[0]['max(shoppingID)']."' class = 'currsess' style = 'display:none'>";
    echo "<td><button class='buttonZT'>Add to Cart</button></td>";
    echo "</form>";
    echo "</tr>";
    echo "</tbody>";    
    }
	mysqli_free_result($result);
	mysqli_close($conn);
?>
</div>

</body>




<script
 src="https://code.jquery.com/jquery-3.2.1.min.js"
 integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
 crossorigin="anonymous"></script>

 <script type="text/javascript" src="itemList.js"></script>

<?php
 if (isset($_SESSION['user']))
 {
	 if ($_SESSION['position'] == "employee")
	 {
		 echo "<script>$('.navitem-shopper').hide();</script>";
		 echo "<script>$('.navitem-both').hide();</script>";
		 echo "<script>$('.site-signin').hide();</script>";
	 }
	 else
	 {
		 echo "<script>$('.site-signin').hide();</script>";
		 echo "<script>$('.navitem-picker').hide();</script>";
	 }
 }
 else
 {
	 echo "<script>$('.site-logout').hide();</script>";
	 echo "<script>$('.navitem-shopper').hide();</script>";
	 echo "<script>$('.navitem-picker').hide();</script>";
 }
 ?>
</html>
