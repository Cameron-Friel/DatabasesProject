<!DOCTYPE html>

<head>

  <title> Log in </title>

  <meta charset="utf-8">

  <link type="text/css" rel="stylesheet" href="style.css" media = "screen">

  <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">

</head>

<body>

<header>

  <h2 class = "site-title"> Food United <a class = "site-signin" href="newShopper.php">Sign In</a></h2>

  <ul class="navlist">
    <li class="navitem"><a href="home.php">Home</a></li>
    <li class="navitem"><a href="about.php">About</a></li>
    <li class="navitem"><a href="itemList.php">Item List</a></li>
     <li class="navitem"><a href="login.php">Account</a></li>
    <li class="navitem"><a href="#">History</a></li>
  </ul>

</header>

<div class = "input-container">

  <form action = "loggedIn.php" method = "post" onsubmit = "return validate()">
    <input type = "text" name = "Username" placeholder = "Username" class = "user">

    <input type = "text" name = "Password" placeholder = "Password" class = "user">

    <input type = "submit" value = "Log In" id = "Submit">
  </form>

</div>

<footer>
 <div class="pageFooter">
   <p class="footerText">Created By:</p>
   <p class="footerText">Cameron Friel and Zach Tusing</p>
   <p class="footerText"><a href = "https://www.twitch.tv/connor75">CONNOR75</a></p>
 </div>
</footer>

</body>

  <script type="text/javascript" src="newUser.js"></script>

</html>
