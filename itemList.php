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
    <li class="navitem"><a href="itemList.php">Products</a></li>
    <li class="navitem"><a href="shoppingCart.php">Cart</a></li>
    <li class="navitem"><a href="shopperHistory.php">History</a></li>
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
	while($row = mysqli_fetch_row($result)) {
		echo "<tr>";
		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable
		foreach($row as $cell)
			if(strpos($cell,'http') !== false)
			{
			    echo "<td><img src=$cell></img></td>";
			}
			else
			{
			    echo "<td>$cell</td>";
			}
		echo "<td><button>Add to Cart</button></td>";
		echo "</tr>\n";
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
