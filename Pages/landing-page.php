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

<div id="homebannerimage">
  <a href="./landing-page.php"><img src="./images/mbl1.jpeg" alt="Moffat Bay Lodge image" id="banner"></a>
  <a href="./landing-page.php"><div id="mblname"><h1>Moffat Bay Lodge</h1></div></a>
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
  <div id="welcome">
  <h1>Welcome to Moffat Bay Lodge</h1>
  <p>
    Hi! We are Moffat Bay Lodge, and we're passionate about creating unforgettable experiences for you. Our mission is to provide you with the ultimate vacation filled with fun and adventure.
  </p>
  
  <h2>Why Choose Moffat Bay Lodge?</h2>
  <p>
    At Moffat Bay Lodge, we pride ourselves on offering the perfect blend of relaxation and excitement. Here are some reasons to choose us for your next getaway:
  </p>
  <ul>
    <li>Stunning Natural Beauty: Our lodge is nestled in the heart of nature, surrounded by breathtaking landscapes.</li>
    <li>Adventure Awaits: Whether you're into hiking, fishing, or simply unwinding by the lake, there's something here for everyone.</li>
    <li>Comfort and Luxury: Our accommodations are designed with your comfort in mind, ensuring a cozy stay.</li>
  </ul>

  <h2>Book Your Stay</h2>
  <p>
    Ready to experience the magic of Moffat Bay Lodge? Reserve your spot today! Our team is here to assist you in planning the perfect vacation.
  </p>
  <a href="./reservation-page.php">Reserve Now</a>

  <h2>Contact Us</h2>
  <p>
    If you have any questions or need assistance, feel free to get in touch with our friendly team. We're here to make your Moffat Bay Lodge experience unforgettable.
  </p>
  <a href="./about-us.php#contact-info" id=>Contact Us</a>
  </div>
</div>
<footer>
  <p id="copyright">Copyright &copy; <script>document.write(new Date().getFullYear())</script>
    Moffat Bay Lodge</p>
</footer>

</div>

</body>
</html>
