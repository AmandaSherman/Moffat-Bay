<!-- 
CSD 460 Capstone Project
Orange Group 2023
Amanda Sherman
Caleb Rummel
Karendaysu Wolfe
Robin Pindel
-->

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
    <a href="./attractions.php">Attractions</a>
  </div>
  <div id="nav3">
  <a href="./about-us.php">About Us</a>
  </div>
</div>

<div id="content-container">
  <div id="attractions">
    <h1>Attractions at Moffat Bay Lodge</h1>
    <p>Discover the myriad of attractions that MBL has to offer! From serene nature trails to exhilarating water sports, there's something for everyone.</p>

    <!-- Hiking -->
    <div class="attraction-box">
      <div class="attraction-title">
        Hiking
        <img src="./images/hiking.jpg" alt="Hiking Image" class="attraction-image">
      </div>
      <div class="attraction-info">Guided Nature Walks: Explore the scenic beauty of Moffat Bay with our experienced guides.</div>
    </div>

    <!-- Kayaking -->
    <div class="attraction-box">
      <div class="attraction-title">
        Kayaking
        <img src="./images/kayaking.jpg" alt="Kayaking Image" class="attraction-image">
      </div>
      <div class="attraction-info">Water Sports: Kayaking, canoeing, and paddleboarding on the pristine waters of the bay.</div>
    </div>

    <!-- Whale Watching -->
    <div class="attraction-box">
      <div class="attraction-title">
        Whale Watching
        <img src="./images/whale-watching.jpg" alt="Whale Watching Image" class="attraction-image">
      </div>
      <div class="attraction-info">Experience the majestic beauty of whales in their natural habitat. A must-see attraction for nature lovers.</div>
    </div>

    <!-- Scuba Diving -->
    <div class="attraction-box">
      <div class="attraction-title">
        Scuba Diving
        <img src="./images/scuba-diving.jpg" alt="Scuba Diving Image" class="attraction-image">
      </div>
      <div class="attraction-info">Dive deep into the waters of Moffat Bay and discover a vibrant underwater world.</div>
    </div>

    <a href="./reservation-page.php" id="reserve-now">Reserve Now</a>
  </div>
</div>

<footer>
  <p id="copyright">Copyright &copy; <script>document.write(new Date().getFullYear())</script>
    Moffat Bay Lodge</p>
</footer>

</div>

</body>
</html>
