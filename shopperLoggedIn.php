<!DOCTYPE html>

<head>

  <title> Logged In </title>

  <meta charset="utf-8">

  <link type="text/css" rel="stylesheet" href="style.css" media = "screen">

</head>

<body>

<header>

  <h2 class = "site-title"> Food United </h2>

  <ul class="navlist">
    <li class="navitem"><a href="home.php">Home</a></li>
    <li class="navitem"><a href="about.php">About</a></li>
    <li class="navitem"><a href="itemList.php">Products</a></li>
  </ul>

</header>

  <?php
    session_start();

    include 'connectvarsEECS.php';

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$conn)
    {
      die('Could not connect: ' . mysql_error());
    }

    $username = mysqli_real_escape_string($conn, $_POST['Username']);
    $password = mysqli_real_escape_string($conn, $_POST['Password']);

    //$sql = "SELECT Username FROM Shopper S, Picker_upper P WHERE Username =
    //'S.$username' AND Password = 'P.$password' OR Username = 'P.$username' AND Password = 'P.$password'";

    $sql = "SELECT Username FROM Shopper WHERE Username = '$username'
    AND Password = '$password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0)
    {
      $_SESSION['user'] = $username;
      echo "<p> Welcome back, ".$_SESSION['user'].". </p>";
    }
    else
    {
      echo "<script>
      alert('Incorrect username or password');
      window.location.href='login.php';
      </script>";
      exit();
    }
    mysqli_free_result($result);

    mysqli_close($conn);
  ?>

</html>
