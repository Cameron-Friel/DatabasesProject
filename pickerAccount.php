<!DOCTYPE html>

<html>
	<head>
		<title>Orders</title>
		<link rel="stylesheet" href="style.css">

		<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
		 <link rel="icon" href="https://image.flaticon.com/icons/png/512/2/2772.png">
	</head>

  <body>

		<header>

		 <h2 class = "site-title"> Food United<a class = "site-signin" href="newShopper.php">Sign In</a>
		 <a class = "site-signin" href = "login.php">Login</a><a class = "site-logout" href = "logout.php">Logout</a></h2>

		 <ul class="navlist">
			 <li class="navitem"><a href="home.php">Home</a></li>
			 <li class="navitem"><a href="about.php">About</a></li>
			 <li class="navitem"><a href="pickerAccount.php">Orders</a></li>
			 <li class="navitem"><a href="pickerHistory.php">History</a></li>
		 </ul>

	 </header>

   <h2 class = "account-overview">List of orders to take</h2>

   <?php
	 		session_start();

      include 'connectvarsEECS.php';

      $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      if (!$conn) {
        die('Could not connect: ' . mysql_error());
      }

      $query = "SELECT O.OrderID, S.Total, G.Name, P.Quantity, Sh.Address FROM Orders O,
      Grocery_item G, Purchased_item P, Shopping_cart S, Shopper Sh WHERE O.EmployeeID IS NULL AND
      O.ShoppingID = S.ShoppingID AND S.ShoppingID = P.ShoppingID AND P.ItemID = G.ItemID
      AND Sh.ShopperID = S.ShopperID ORDER BY O.OrderID";

      $result = mysqli_query($conn, $query);

      $orders = array();

      while ($order = mysqli_fetch_assoc($result))
      {
        $orders[] = $order;
      }

      $length = count($orders);
      $count = 0;
      $currentID = $orders[0]['OrderID'];

      if ($length > 0)
      {
        echo "<div class = 'order-container'>";
        echo "<h2 class = 'order-title'>Order ".$orders[0]['OrderID']." </h2>";
        echo "<h2 class = 'click'> Address: ".$orders[0]['Address']."</h2>";
        echo "<table class = 'order-table'>";
        echo "<tr>";
        echo "<th class = 'order-row'>Product Name</th>";
        echo "<th class = 'order-row'>Quantity</th>";
        echo "</tr>";
      }

      for ($i = 0; $i < $length; $i++)
      {
        if ($currentID != $orders[$i]['OrderID'])
        {
          $currentID = $orders[$i]['OrderID'];

          echo "</table>";
          echo "<p class = 'total-order'>Total: ".$orders[$count]['Total']."</p>";
          echo "<form action = 'insertJob.php' type = 'post'>";
          echo "<input type='text' name='picker' value='".$_SESSION['id']."' class = 'pick-name' style = 'display:none'>";
					echo "<input type='text' name='order' value='".$orders[$count]['OrderID']."' class = 'order-name' style = 'display:none'>";
				  echo "<button type = 'submit' class = 'accept-order'>Accept Order</button>";
          echo "</form>";
          echo "</div>";

          echo "<div class = 'order-container'>";
          echo "<h2 class = 'order-title'>Order ".$orders[$i]['OrderID']." </h2>";
          echo "<h2 class = 'click'> Address: ".$orders[$i]['Address']."</h2>";
          echo "<table class = 'order-table'>";
          echo "<tr>";
          echo "<th class = 'order-row'>Product Name</th>";
          echo "<th class = 'order-row'>Quantity</th>";
          echo "</tr>";

          $count = $count + 1;
        }
        echo "<tr>";
        echo "<td class = 'order-row'>".$orders[$i]['Name']."</td>";
        echo "<td class = 'order-row'>".$orders[$i]['Quantity']."</td>";
        echo "</tr>";
      }

      if ($length > 0)
      {
        echo "</table>";
        echo "<p class = 'total-order'>Total: ".$orders[$length - 1]['Total']."</p>";
        echo "<form action = 'insertJob.php' type = 'post'>";
        echo "<input type='text' name='picker' value='".$_SESSION['id']."' class = 'pick-name' style = 'display:none'>";
				echo "<input type='text' name='order' value='".$orders[$length - 1]['OrderID']."' class = 'order-name' style = 'display:none'>";
				echo "<button type = 'submit' class = 'accept-order'>Accept Order</button>";
        echo "</form>";
        echo "</div>";
      }

    	mysqli_free_result($result);
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

<script type="text/javascript" src="pickerAccount.js"></script>

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
