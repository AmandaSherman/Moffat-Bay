<!DOCTYPE html>
<html lang="en-us">
<head>
  <link href="./mbl.css" type="text/css" rel="stylesheet">
</head>
<body>

<div id="main">

<div id="lookuplink">
  <a href="./reservation-lookup.php">Look Up Reservation</a>
</div>

<?php
  session_start();
  include('db-config.php');
  
  if (!array_key_exists('customerid',$_SESSION)) {
    echo "<div id=\"accountlinks\">";
    echo "<a href=\"./login-page.php\"><img src=\"./images/iconsolid.png\" width=\"13px\" height=\"13px\">Login</a>";
    echo "<a href=\"./register-page.php\">Sign Up</a>";
    echo "</div>";
  }
  else {
    $customerid = $_SESSION['customerid'];
    $query = $connection->prepare("SELECT email FROM customer WHERE customerid=:customerid");
    $query->bindParam("customerid", $customerid, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $email = $result['email'];
    echo "<div id=\"accountlinks\">";
    echo "<img src=\"./images/iconsolid.png\" width=\"13px\" height=\"13px\">" .  $email;
    echo "<a href=\"logout-code.php\">Log Out</a>";
    echo "</div>";
  }
?>

<div id="bannerimage">
  <a href="./landing-page.php"><img src="./images/mbl1.jpeg" alt="Moffat Bay Lodge image" id="banner"></a>
  <div id="mblname"><h1>Moffat Bay Lodge</h1></div>
</div>
<div id="navigationbar">
  <div id="nav1">
    <a href="./reservation-page.php">Reserve</a>
  </div>
  <div id="nav2">
    <a href="#">Attractions</a>
  </div>
  <div id="nav3">
    <a href="#">About Us</a>
  </div>
</div>

<div id="content-container">

<?PHP
  function redirect($url) {
    header('Location: '.$url);
    die();
  }  

  $checkin = $_POST["checkin"];
  $checkin = strtotime($checkin);
  $checkin = date("Y-m-d", $checkin);
  $checkout = $_POST["checkout"];
  $checkout = strtotime($checkout);
  $checkout = date("Y-m-d", $checkout);
  $numberguests = (int)$_POST["number-guests"];
  $roomsize = $_POST["room-size"];
  
  $query = $connection->prepare("INSERT INTO reservation(customerid,checkin,checkout,numberguests,roomsize) VALUES (:customerid,:checkin,:checkout,:numberguests,:roomsize)");
  $query->bindParam("customerid", $customerid, PDO::PARAM_STR);
  $query->bindParam("checkin", $checkin, PDO::PARAM_STR);
  $query->bindParam("checkout", $checkout, PDO::PARAM_STR);
  $query->bindParam("numberguests", $numberguests, PDO::PARAM_STR);
  $query->bindParam("roomsize", $roomsize, PDO::PARAM_STR);
  $result = $query->execute();
  if ($result) {
    echo "<br />";
    echo "<p class=\"success\">Your reservation has been booked successfully!</p>";
    /*echo "***Testing*** <br /><br />";
    echo "Requested check-in date: " . $checkin . "<br /><br />";
    echo "Requested check-out date: " . $checkout . "<br /><br />";
    echo "Number of guests on reservation: " . $numberguests . "<br /><br />";
    echo "Requested room size (beds): " . $roomsize . "<br /><br />";*/
  }
  else {
    echo '<p class="error">Something went wrong!</p>';
  }
?>

</div>

<footer>
  <p id="copyright">Copyright &copy; <script>document.write(new Date().getFullYear())</script>
    Moffat Bay Lodge</p>
</footer>

</div>

</body>
</html>
