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
 		 <a class = "site-signin" href = "shopperLogin.php">Login</a></h2>

		 <ul class="navlist">
			 <li class="navitem"><a href="home.php">Home</a></li>
			 <li class="navitem"><a href="about.php">About</a></li>
			<li class="navitem"><a href="itemList.php">Item List</a></li>
		 </ul>

	 </header>

   <?php
      session_start();

      echo "<p class = 'center-message'>You have logged out successfully, ".$_SESSION['user'].".</p>";

      session_destroy();
   ?>

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

 </html>
