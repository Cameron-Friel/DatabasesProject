<?php
	session_start();
 ?>

<!DOCTYPE html>

<html>
	<head>
		<title>Home Page</title>
		<link rel="stylesheet" href="style.css">

		<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
		<link rel="icon" href="https://image.flaticon.com/icons/png/512/2/2772.png">
	</head>

  <body>

		<header>

		 <h2 class = "site-title"> Food United<a class = "site-signin" href="newShopper.php">Sign Up</a>
		 <a class = "site-signin" href = "shopperLogin.php">Login</a><a class = "site-logout" href = "logout.php">Logout</a></h2>

		 <ul class="navlist">
			<li class="navitem"><a href="home.php">Home</a></li>
 			<li class="navitem"><a href="about.php">About</a></li>
 			<li class="navitem-both"><a href="itemList.php">Products</a></li>
 			<li class="navitem-shopper"><a href="#">Cart</a></li>
 			<li class="navitem-shopper"><a href="shopperHistory.php">History</a></li>
 			<li class="navitem-picker"><a href="pickerAccount.php">Orders</a></li>
 			<li class="navitem-picker"><a href="pickerHistory.php">History</a></li>
		 </ul>

	 </header>

	 <div></div>

		<?php
		include 'connectvarsEECS.php';

		$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if (!$conn) {
				die('Could not connect: ' . mysql_error());
		}

			$sql = "SELECT Image FROM Grocery_item";
			$result = mysqli_query($conn, $sql);

			while($row = mysqli_fetch_assoc($result))
			{
				echo "<img class = 'mySlides' src='".$row['Image']."' width='500' height='300'/>";
 			}
			mysqli_free_result($result);
			mysqli_close($conn);
		 ?>

		 <div class = "info">Food United is a company driven to serve groceries to YOU. We pride ourselves
		 on our self driven drivers which take your orders and deliver them to you at light speed.</div>

		 <div class = "push"></div>

		 <footer>
    	<div class="pageFooter">
        <p class="footerText">Created By:</p>
        <p class="footerText">Cameron Friel and Zach Tusing</p>
				<p class="footerText"><a href = "https://www.twitch.tv/connor75">CONNOR75</a></p>
    	</div>
		</footer>

  </body>

	<script
 src="https://code.jquery.com/jquery-3.2.1.min.js"
 integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
 crossorigin="anonymous"></script>

 <script type="text/javascript" src="home.js"></script>

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
