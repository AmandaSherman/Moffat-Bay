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
    <h1>Attractions at Moffat Bay Lodge (MBL)</h1>
    <p>Discover the myriad of attractions that MBL has to offer! From serene nature trails to exhilarating water sports, there's something for everyone.</p>
    <br />
    <!-- Hiking -->
    <div class="attraction-box">
      <div class="attraction-title">
        Hiking
        <img src="./images/hiking.jpg" alt="Hiking Image" class="attraction-image">
      </div>
      <!-- Robin tried adding more text to eliminate whitespace
      <div class="attraction-info">Guided Nature Walks: Explore the scenic beauty of Moffat Bay with our experienced guides.</div>
      -->
      <div class="attraction-info">
        <p>MBL offers several options for those looking to experience the scenic beauty of Moffat Bay by foot.
          <ul>
            <li>Guided Nature Walk - Let an experienced guide lead the way and show the wonders of the area.  For the casual walker/hiker.</li>
            <li>Guided Hike - Looking to marvel at nature and enjoy a challenge?  For the knowledgeable hiker, have one of our guides show you the trails off the beaten path and enjoy some less-seen sights.</li>
            <li>Self-Guided Exploration - If you prefer to explore truly at your own pace, grab a map and follow one of the many curated trails.  There are trails available in several lengths and difficulties.</li>
          </ul>
        </p>
      </div>
    </div>

    <!-- Kayaking -->
    <div class="attraction-box">
      <div class="attraction-title">
        Kayaking
        <img src="./images/kayaking.jpg" alt="Kayaking Image" class="attraction-image">
      </div>
      <!-- Robin tried adding more text to eliminate whitespace
      <div class="attraction-info">Water Sports: Kayaking, canoeing, and paddleboarding on the pristine waters of the bay.</div>
      -->
      <div class="attraction-info">
        <p>The pristine waters of Moffat Bay offer a great waterway for all levels of kayaker.
          <ul>
            <li>Feel free to bring your own or rent one from MBL</li>
            <li>Guided kayak tours available</li>
            <li>Canoes and paddleboards are also welcome and available for rent</li>
          </ul>
        </p>
      </div>
    </div>

    <!-- Whale Watching -->
    <div class="attraction-box">
      <div class="attraction-title">
        Whale Watching
        <img src="./images/whale-watching.jpg" alt="Whale Watching Image" class="attraction-image">
      </div>
      <div class="attraction-info">
        <p>Experience the majestic beauty of whales in their natural habitat.  A must-see attraction for nature lovers.
          <ul>
            <li>The best views are offered from regular boat tours in the bay and nearby waters.</li>
            <li>Other views available from land at desginated whale watching spots.  These are great spots for stationary photography setups.</li>
          </ul>
        </p>
      </div>
    </div>

    <!-- Scuba Diving -->
    <div class="attraction-box">
      <div class="attraction-title">
        Scuba Diving
        <img src="./images/scuba-diving.jpg" alt="Scuba Diving Image" class="attraction-image">
      </div>
      <div class="attraction-info">
        <p>Dive deep into the waters of Moffat Bay and discover a vibrant underwater world.
          <ul>
            <li>Experienced divers available to take you around on a guided excursion highlighting major areas of interest and intrigue under the surface of the bay.</li>
            <li>Play at your own pace and wander through the depths in designated exploration zones.</li>
          </ul>
        </p>
      </div>
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
