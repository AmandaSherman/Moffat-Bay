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
  
  if (!array_key_exists('customerid', $_SESSION)) {
    echo "<div id=\"accountlinks\">";
    echo "<a href=\"./login-page.php\"><img src=\"./images/iconsolid.png\" width=\"13px\" height=\"13px\">Login</a>";
    echo "<a href=\"./register-page.php\">Sign Up</a>";
    echo "</div>";
  } else {
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
  <div id="welcome">
    <h1>About Moffat Bay Lodge (MBL)</h1>
    <p>
      Welcome to Moffat Bay Lodge (MBL), where adventure meets relaxation. Nestled in the heart of nature, MBL offers you the perfect escape from the everyday hustle and bustle. Our mission is to create lasting memories and provide you with an unforgettable vacation experience.
    </p>
    
    <h2>Our Story</h2>
    <p>
      Moffat Bay Lodge has been a cherished destination for travelers for over a decade. Our journey began with a simple idea: to share the beauty of nature and the joy of adventure with our guests. Over the years, we've grown, evolved, and embraced the unique character of the lodge.
    </p>

    <h2>What Sets Us Apart</h2>
    <p>
      At MBL, we take pride in offering a one-of-a-kind experience. Here's what sets us apart:
    </p>
    <ul>
      <li>Idyllic Location: Our lodge is situated in a pristine natural setting, surrounded by breathtaking landscapes, lush forests, and serene lakes.</li>
      <li>Adventure Awaits: Whether you're an outdoor enthusiast or looking to unwind, we offer a wide range of activities, from hiking and fishing to stargazing by the campfire.</li>
      <li>Luxury Meets Comfort: Our accommodations are thoughtfully designed to provide you with the perfect blend of luxury and coziness, ensuring a relaxing stay.</li>
      <li>Personalized Service: Our friendly and knowledgeable staff are dedicated to making your stay truly memorable, assisting you every step of the way.</li>
    </ul>

    <h2>Join Us in Creating Memories</h2>
    <p>
      We invite you to be part of the MBL experience. Whether you're planning a family vacation, a romantic getaway, or an adventure with friends, Moffat Bay Lodge is here to make it extraordinary.
    </p>
    <a href="./reservation-page.php">Book Your Stay</a>
  </div>
</div>

<footer>
  <p id="copyright">Copyright &copy; <?php echo date("Y"); ?> Moffat Bay Lodge</p>
</footer>

</div>

</body>
</html>
