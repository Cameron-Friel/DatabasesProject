<!DOCTYPE html>

<head>

  <title> Login Successful </title>

  <meta charset="utf-8">

  <link type="text/css" rel="stylesheet" href="style.css" media = "screen">

  <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">

</head>

<body>

  <header>

   <h2 class = "site-title"> Food United </h2>

   <ul class="navlist">
     <li class="navitem"><a href="home.php">Home</a></li>
     <li class="navitem"><a href="about.php">About</a></li>
     <li class="navitem"><a href="pickerAccount.php">Orders</a></li>
     <li class="navitem"><a href="#">History</a></li>
   </ul>

 </header>

  <h2> User result: </h2>

  <?php
    include 'connectvarsEECS.php';

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$conn)
    {
      die('Could not connect: ' . mysql_error());
    }

    function generateRandomSalt()
    {
      return base64_encode(mcrypt_create_iv(12, MCRYPT_DEV_URANDOM));
    }

    $username = mysqli_real_escape_string($conn, $_POST['Username']);
    $password = mysqli_real_escape_string($conn, $_POST['Password']);
    $first = mysqli_real_escape_string($conn, $_POST['First_name']);
    $last = mysqli_real_escape_string($conn, $_POST['Last_name']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['Phone_number']);
    $credit_card = mysqli_real_escape_string($conn, $_POST['Credit_card']);
    $address = mysqli_real_escape_string($conn, $_POST['Address']);

    //Check if username is already taken

    $takenUser = mysqli_query($conn, "select * FROM Picker_upper WHERE Username = '$username'");

    if (mysqli_num_rows($takenUser) > 0)
    {
      echo "<script>
      alert('This username has already been taken.');
      window.location.href='newShopper.php';
      </script>";
      exit();
    }

    if (!preg_match("/^[a-zA-Z0-9]*$/", $username) || !preg_match("/^[a-zA-Z0-9]*$/", $password)) //check if username and password is correct
    {
      echo "<script>
      alert('Please do not use special characters.');
      window.location.href='newUser.php';
      </script>";
      exit();
    }

    if (!preg_match("/^[_a-zA-Z- ]+$/", $first) || !preg_match("/^[_a-zA-Z- ]+$/", $last)) //check if first and last name is correct
    {
      echo "<script>
      alert('Please do not use special characters or numbers for your first and last name.');
      window.location.href='newUser.php';
      </script>";
      exit();
    }

    $result = mysqli_query($conn, "SELECT MAX(EmployeeID) FROM Picker_upper LIMIT 1");

    $id = mysqli_fetch_array($result);

    $sendID = $id[0];
    $sendID += 1;

    $query = "INSERT INTO Picker_upper (Username, Password, First_name, Last_name, Phone_number, Credit_card,
    Address, EmployeeID) VALUES ('$username', '$password', '$first', '$last', '$phone_number', '$credit_card',
    '$address', '$sendID')";

    if (mysqli_query($conn, $query))
    {
      echo "Record added successfully.";
    }
    else
    {
      echo "ERROR, was not able to send: $query. " . mysqli_error($conn);
    }

    mysqli_free_result($takenUser);

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

</html>
