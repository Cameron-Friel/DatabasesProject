<!DOCTYPE html>

<html>
	<head>
		<title>About</title>
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

	<?php
		 session_start();

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
