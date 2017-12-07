<!DOCTYPE html>

<html>
	<head>
		<title>Your Shopping Cart</title>

    <meta charset="utf-8">

		<link rel="stylesheet" href="style.css">

    <link rel="icon" href="https://image.flaticon.com/icons/png/512/2/2772.png">
  
		<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
	</head>

  <body>

		<header>

  <h2 class = "site-title"> Food United <a class = "site-signin" href="newShopper.php">Sign Up</a>
		 <a class = "site-signin" href = "shopperLogin.php">Login</a></h2>

		 <ul class="navlist">
			 <li class="navitem"><a href="home.php">Home</a></li>
			 <li class="navitem"><a href="about.php">About</a></li>
       <li class="navitem"><a href="itemList.php">Item List</a></li>
			 <li class="navitem"><a href="shopperLogin.php">Account</a></li>
			 <li class="navitem"><a href="#">History</a></li>
		 </ul>

	 </header>

   <h3 class = "account-overview">Your Cart: </h3>

   <div id="total">

<?php

    session_start();

  include 'connectvarsEECS.php';

      $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if (!$conn) {
    die('Could not connect: ' . mysql_error());
  }
// Retrieve name of table selected
  //$table = $_POST['Grocery_item'];
  $query = "SELECT Total FROM Shopping_cart where shoppingID = 1;";

  $result = mysqli_query($conn, $query);
  if (!$result) {
    die("Query to show fields from table failed");
  }

  $totals = array();

  while ($total = mysqli_fetch_assoc($result))
    {
      $totals[] = $total;
    }
    echo "<h2>Total:  ".$totals[0]['Total']."</h2>";
    echo "<h2><button>Checkout</button></h2>";

  mysqli_free_result($result);
  mysqli_close($conn);
?>
</div>

   <div id="shoppingtableZT">
    <?php

    session_start();

  include 'connectvarsEECS.php';

      $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if (!$conn) {
    die('Could not connect: ' . mysql_error());
  }

  $query = "SELECT max(shoppingID) FROM Shopping_cart where shopperID = ".$_SESSION['user'].";";

  $result = mysqli_query($conn, $query);
  if (!$result) {
    die("You are not Logged in!");
  }

  $shoppingIDS = array();

  while ($shoppingID = mysqli_fetch_assoc($result))
    {
      $shoppingIDS[] = $shoppingID;
    }

// Retrieve name of table selected
  //$table = $_POST['Grocery_item'];
  $query = "SELECT Name,Info,Calories,Price,Image FROM Grocery_item tblg, Purchased_item tblp where tblp.itemID = tblg.itemID and tblp.ShoppingID = ".shoppingIDS[0]['ShoppingID'].";";

  $result = mysqli_query($conn, $query);
  if (!$result) {
    die("Query to show fields from table failed");
  }
  $fields_num = mysqli_num_fields($result);
  echo "<table border='1' rules=none><tr>";

// printing table headers
  for($i=0; $i<$fields_num; $i++) {
    $field = mysqli_fetch_field($result);
    echo "<td><b>$field->name</b></td>";
  }
  echo "<td><b>Remove</b></td>";
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
    echo "<td><button>Remove from Cart</button></td>";
    echo "</tr>\n";
  }

  mysqli_free_result($result);
  mysqli_close($conn);
?>

</div>
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

<script type="text/javascript" src="pickerAccount.js"></script>

</html>
