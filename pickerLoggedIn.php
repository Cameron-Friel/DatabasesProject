<!DOCTYPE html>

<head>

  <title> Logged In </title>

  <meta charset="utf-8">

  <link type="text/css" rel="stylesheet" href="style.css" media = "screen">
   <link rel="icon" href="https://image.flaticon.com/icons/png/512/2/2772.png">

</head>

<body>

<header>

  <h2 class = "site-title"> Food United </h2>

  <ul class="navlist">
    <li class="navitem"><a href="home.php">Home</a></li>
    <li class="navitem"><a href="about.php">About</a></li>
    <li class="navitem"><a href="pickerAccount.php">Orders</a></li>
    <li class="navitem"><a href="pickerHistory.php">History</a></li>
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

    $sql = "SELECT Username, EmployeeID FROM Picker_upper WHERE Username = '$username'
    AND Password = '$password'";

    $result = mysqli_query($conn, $sql);

    $myUser = array();

    while ($row = mysqli_fetch_assoc($result))
    {
      $myUser[] = $row;
    }

    if (mysqli_num_rows($result) > 0)
    {
      $_SESSION['user'] = $username;
      $_SESSION['id'] = $myUser[0]['EmployeeID'];
      $_SESSION['position'] = "employee";
      echo "<p class = 'center-message'> Welcome back, ".$_SESSION['user'].". </p>";
    }
    else
    {
      echo "<script>
      alert('Incorrect username or password');
      window.location.href='pickerLogin.php';
      </script>";
      exit();
    }

    mysqli_free_result($result);

    mysqli_close($conn);
  ?>

</html>
