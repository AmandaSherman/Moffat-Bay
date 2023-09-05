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
  <a href="./about-us.php">About Us</a>
  </div>
</div>

<div id="content-container">

<script>
  var redirect = function(){
   document.location.href="./reservation-page.php"
}
</script>

<?PHP

$reservevalid = TRUE;
$today = date("Y-m-d");
$checkin = $_POST["checkin"];
$checkout = $_POST["checkout"];
$diffcheckin = date_create($checkin);
$diffcheckout = date_create($checkout);
$interval = date_diff($diffcheckin, $diffcheckout);
$numbernights = $interval->format("%a");
$numberguests = $_POST["number-guests"];
$roomsize = $_POST["room-size"];
if ($numberguests == 1 || $numberguests == 2) {
  $price = 120.75 * $numbernights;
}
else {
  $price = 157.50 * $numbernights;
}

if ($checkin < $today && $checkout <= $today) {
  $reservevalid = FALSE;
  echo "<br /><br />";
  echo "Check-in date must be equal to today's date or later and check-out date must be after tomorrow or later.<br /><br />";
  echo "<a href=\"./reservation-page.php\">Please go back and correct the issue.  Thank you.</a>";
  echo "<br /><br />";  
}
elseif ($checkin < $today) {
  $reservevalid = FALSE;
  echo "<br /><br />";
  echo "Check-in date must be equal to today's date or later.<br /><br />";
  echo "<a href=\"./reservation-page.php\">Please go back and correct the issue.  Thank you.</a>";
  echo "<br /><br />";
}
elseif ($checkout <= $today) {
  $reservevalid = FALSE;
  echo "<br /><br />";
  echo "Check-out date must be after tomorrow or later.<br /><br />";
  echo "<a href=\"./reservation-page.php\">Please go back and correct the issue.  Thank you.</a>";
  echo "<br /><br />";
}

if (!isset($customerid)) {
  $reservevalid = FALSE;
  echo "<br /><br />";
  echo "You need an account to make a reservation.<br /><br />";
  echo "<a href=\"./login-page.php\"> Please sign up for an account, login, and try again.</a>";
  echo "<br /><br />";
}

if ($reservevalid) {
?>

  <div id="res-review-details">
    <div>
      <label>Requested Check-In Date:</label>
      &emsp;<?PHP echo htmlspecialchars($checkin); ?>
    </div>
    <div>
      <label>Requested Check-Out Date:</label>
      &emsp;<?PHP echo htmlspecialchars($checkout); ?>
    </div>
    <div> 
      <label>Number of Guests:</label>
      &emsp;<?PHP echo htmlspecialchars($numberguests); ?>
    </div>
    <div>
      <label>Requested Room Size (Beds):</label>
      &emsp;<?PHP echo htmlspecialchars($roomsize); ?>
    </div>
    <div>
      <label>Reservation Cost:</label>
      &emsp;<?PHP echo htmlspecialchars(number_format((float)$price, 2, '.', '')); ?>
    </div>
  </div>

<form class="hidden" action="reservation-confirmed.php" method="post">
  <input type="hidden" name="checkin" value="<?PHP echo htmlspecialchars($checkin); ?>" />
  <input type="hidden" name="checkout" value="<?PHP echo htmlspecialchars($checkout); ?>" />
  <input type="hidden" name="number-guests" value="<?PHP echo htmlspecialchars($numberguests); ?>" />
  <input type="hidden" name="room-size" value="<?PHP echo htmlspecialchars($roomsize); ?>" />
  <input type="hidden" name="customerid" value="<?PHP echo htmlspecialchars($customerid); ?>" />
  <button class="reg" type="reset" name="cancel" value="cancel" onclick="redirect()">Cancel</button>
  <button class="res" type="submit" name="reserve" value="reserve">Book It!</button>
</form>

<?PHP
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
