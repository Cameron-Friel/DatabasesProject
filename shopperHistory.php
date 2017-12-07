<!DOCTYPE html>

<html>
	<head>
		<title>History</title>
		<link rel="stylesheet" href="style.css">

		<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
     <link rel="icon" href="https://image.flaticon.com/icons/png/512/2/2772.png">
	</head>

  <body>

		<header>

		 <h2 class = "site-title"> Food United<a class = "site-signin" href="newShopper.php">Sign In</a>
		 <a class = "site-signin" href = "shopperLogin.php">Login</a><a class = "site-logout" href = "logout.php">Logout</a></h2>

		 <ul class="navlist">
			 <li class="navitem"><a href="home.php">Home</a></li>
			 <li class="navitem"><a href="about.php">About</a></li>
			 <li class="navitem"><a href="itemList.php">Products</a></li>
			 <li class="navitem"><a href="shoppingCart.php">Cart</a></li>
			 <li class="navitem"><a href="shopperHistory.php">History</a></li>
		 </ul>

	 </header>

   <h2 class = "account-overview">History of Orders:</h2>

   <?php
	 	session_start();

    include 'connectvarsEECS.php';

     $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
     if (!$conn) {
       die('Could not connect: ' . mysql_error());
     }

     $query = "SELECT O.OrderID, O.Picker_signature, O.Shopper_signature, S.Address, S.First_name,
     S.Last_name, P.First_name AS 'Picker_first', P.Last_name AS 'Picker_last' FROM Shopper S,
     Orders O, Picker_upper P WHERE O.EmployeeID = '".$_SESSION['id']."' AND S.ShopperID = O.ShopperID
		 AND P.EmployeeID = '".$_SESSION['id']."' GROUP BY O.OrderID";

		 $secondQuery = "SELECT O.OrderID, S.Total, G.Name, P.Quantity FROM Orders O, Grocery_item G, Purchased_item P,
		 Shopping_cart S, Shopper Sh WHERE O.ShopperID = '".$_SESSION['id']."' AND O.ShoppingID = S.ShoppingID AND
		 S.ShoppingID = P.ShoppingID AND P.ItemID = G.ItemID AND Sh.ShopperID = S.ShopperID
		 ORDER BY O.OrderID";

     $result = mysqli_query($conn, $query);
		 $secondResult = mysqli_query($conn, $secondQuery);

     $histories = array();
		 $products = array();

     while ($history = mysqli_fetch_assoc($result))
     {
       $histories[] = $history;
     }

		 while ($product = mysqli_fetch_assoc($secondResult))
		 {
			 $products[] = $product;
		 }

     $length = count($histories);
		 $secondLength = count($products);

     $pSignature;
     $sSigntature;

     for ($i = 0; $i < $length; $i++)
     {
       if ($histories[$i]['Picker_signature'] == 0)
       {
         $pSignature = "No";
       }
       else
       {
         $pSignature = "Yes";
       }

       if ($histories[$i]['Shopper_signature'] == 0)
       {
         $sSignature = "No";
       }
       else
       {
         $sSignature = "Yes";
       }

       echo "<div class = 'order-container'>";
       echo "<h2 class = 'order-title'>Order ".$histories[$i]['OrderID']."</h2>";
       echo "<div class = 'address-title'> Address: ".$histories[$i]['Address']."</div>";
       echo "<table class = 'order-table'>";
       echo "<tr>";
       echo "<th class = 'history-row'>Participants</th>";
       echo "<th class = 'history-row'>Delivered?</th>";
       echo "</tr>";
       echo "<tr>";
       echo "<td class = 'history-row'>Shopper: ".$histories[$i]['First_name']." ".$histories[$i]['Last_name']."</td>";
       echo "<form action = 'insertShopperSig.php' type = 'post'>";
       echo "<input type = 'text' name = 'signature' value = '1' class = 'sig-name' style = 'display:none'>";
       echo "<input type = 'text' name = 'order' value = '".$histories[$i]['OrderID']."' class = 'sig-name' style = 'display:none'>";
			 echo "<input type = 'text' name = 'employee' value = '".$_SESSION['id']."' class = 'sig-name' style = 'display:none'>";
			 echo "<td class = 'history-row'><button type = 'submit' class = '".$sSignature."'>".$sSignature."</button></td>";
       echo "</form>";
       echo "</tr>";
       echo "<tr>";
       echo "<td class = 'history-row'>Deliverer: ".$histories[$i]['Picker_first']." ".$histories[$i]['Picker_last']."</td>";
       echo "<form action = 'insertSignature.php' type = 'post'>";
			 echo "<td class = 'history-row'><button type = 'submit' class = '".$pSignature."-not'>".$pSignature."</button></td>";
       echo "</tr>";
       echo "</table>";
			 echo "<table class = 'order-table'>";
			 echo "<tr>";
			 echo "<th class = 'order-row'>Items</th>";
			 echo "<th class = 'order-row'>Quantity</th>";
			 echo "</tr>";

			 $count = 0;

			 for ($j = 0; $j < $secondLength; $j++)
			 {
				 if ($products[$j]['OrderID'] == $histories[$i]['OrderID'])
				 {
					 echo "<tr>";
					 echo "<td class = 'order-row'>".$products[$j]['Name']."</td>";
					 echo "<td class = 'order-row'>".$products[$j]['Quantity']."</td>";
					 echo "</tr>";
					 $count = $count + 1;
				 }
			 }
			 echo "<p class = 'total-order'>Total: ".$products[$count - 1]['Total']."</p>";
			 echo "</table>";
			 echo "</div>";
     }
     mysqli_free_result($result);
		 mysqli_free_result($secondResult);
     mysqli_close($conn);
    ?>
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

   <script type="text/javascript" src="shopperHistory.js"></script>

   <?php
   	 if (isset($_SESSION['user']))
   	 {
   		 echo "<script>$('.site-signin').hide();</script>";
   	 }
   	 else
   	 {
   		 echo "<script>$('.site-logout').hide();</script>";
   	 }
   ?>

   </html>
