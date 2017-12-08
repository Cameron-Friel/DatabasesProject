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

   <h3 class = "account-overview">Your Cart: </h3>

   <div id="total">

<?php
  
  
    session_start(); //start session

  include 'connectvarsEECS.php';

      $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if (!$conn) {
    die('Could not connect: ' . mysql_error());
  }
// Retrieve name of table selected
  //$table = $_POST['Grocery_item'];
  $query = "SELECT max(shoppingID) FROM Shopping_cart where shopperID = '".$_SESSION['id']."'"; //query returns the curr users curr shopping cart

  $result = mysqli_query($conn, $query);
  if (!$result) {
    die("You are not Logged in!");
  }

  $shoppingIDS = array();

  while ($shoppingID = mysqli_fetch_assoc($result))
    {
      $shoppingIDS[] = $shoppingID;
    } //this stores the shopping cart in an array

    //echo $shoppingIDS[0]['ShoppingID'];


  $query = "SELECT Total,shoppingID FROM Shopping_cart where shoppingID = '".$shoppingIDS[0]['max(shoppingID)']."';"; //this query returns the total for the users shopping cart

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
  echo "<form action ='checkout.php' id='check' class='check' type='post'>";
  echo "<input type = 'text' name = 'shoppingID' value = '".$row['shoppingID']."' class = 'nameZT' style = 'display:none'>";
  echo "<input type = 'text' name = 'Total' value = '".$row['Total']."' class = 'nameZT' style = 'display:none'>";
  echo "<input type = 'text' name = 'ItemID' value = '".$_SESSION['id']."' class = 'nameZT' style = 'display:none'>";
  echo "<input type = 'text' name = 'shoppingID' value = '".$shoppingIDS[0]['max(shoppingID)']."' class = 'currsess' style = 'display:none'>";
  echo "<h2><button>Checkout</button></h2>";
  echo "</form>";
    
//this prints out the users shopping cart
  mysqli_free_result($result);
  mysqli_close($conn);
?>
</div>

   <div id="shoppingtableZT">
    <?php
  include 'connectvarsEECS.php';

      $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if (!$conn) {
    die('Could not connect: ' . mysql_error());
  }

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
    //echo $shoppingIDS[0]['ShoppingID'];
// Retrieve name of table selected
  //$table = $_POST['Grocery_item'];
  $query = "SELECT Name,Info,Calories,Price,Image,Quantity,tblp.ItemID FROM Grocery_item tblg, Purchased_item tblp where tblp.itemID = tblg.itemID and tblp.ShoppingID = '".$shoppingIDS[0]['max(shoppingID)']."'";

  //echo $query;

  $result = mysqli_query($conn, $query);
  if (!$result) {
    die("Nothing is in your cart!");
  }
  $fields_num = mysqli_num_fields($result);
  echo "<table border='1' rules=none><tr>";

// printing table headers
  for($i=1; $i<$fields_num; $i++) {
    $field = mysqli_fetch_field($result);
    echo "<td><b>$field->name</b></td>";
  }
  echo "<td><b>Remove</b></td>";
  echo "</tr>\n";
  //echo "<th> Accept</th>";
  while($row = mysqli_fetch_array($result)) {
     //these statements are to print out the html tables in the correct formatting with what the user has
    echo "<tbody data-link='row' class='rowlink'>";
    echo "<tr>";
    echo "<td><div id = 'name'>" . $row['Name'] . "</div></td>";
    echo "<td>" . $row['Info'] . "</td>";
    echo "<td>" . $row['Calories'] . "</td>";
    echo "<td>" . $row['Price'] . "</td>";
    echo "<td><img src ='" . $row['Image'] . "'></img></td>";
    echo "<td>" . $row['Quantity'] . "</td>";
    echo "<form action ='removeCart.php' type='post'>";
    echo "<input type = 'text' name = 'ItemID' value = '".$row['ItemID']."' class = 'nameZT' style = 'display:none'>";
    echo "<input type = 'text' name = 'shoppingID' value = '".$shoppingIDS[0]['max(shoppingID)']."' class = 'currsess' style = 'display:none'>";
    echo "<td><button class='buttonZT'>Remove from Cart</button></td>";
    echo "</form>";
    echo "</tr>";
    echo "</tbody>";    
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

 <script type="text/javascript" src="shoppingCart.js"></script>
<?php
 if (isset($_SESSION['user']))
 {
  //These hide items based on what kind of session the user is in
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
