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
    
    <h2>About Moffat Bay Lodge (MBL)</h2>
<p>
  Six months ago, the San Juan Islands First Nations Development Committee approved the construction of a resort and marina at Moffat Bay on Joviedsa Island. The construction of both the lodge and marina is now in its final stages, and we're excited to be a part of this project.
</p>

<p>
  At Moffat Bay Lodge (MBL), we've been entrusted with the responsibility of completing one of the two projects required before the facilities open to the public. Our mission is to ensure that the lodge or marina, depending on your choice, is ready to offer a remarkable experience for our guests.
</p>

<h2>Why Choose MBL?</h2>
<p>
  At MBL, we're committed to excellence and sustainability. Here are some reasons to choose us for your next project:
</p>
<ul>
  <li>San Juan Islands Beauty: Our location on Joviedsa Island offers a stunning natural backdrop, with breathtaking views of the San Juan Islands.</li>
  <li>Quality Craftsmanship: We take pride in our attention to detail and commitment to delivering a high-quality resort or marina.</li>
  <li>Community and Culture: We embrace the heritage and culture of the San Juan Islands First Nations, making your project a part of this rich history.</li>
  <li>Project Partnership: We work closely with our clients to ensure your vision becomes a reality, meeting your project goals and timelines.</li>
</ul>

<h2>Partner with Us</h2>
<p>
  We invite you to partner with Moffat Bay Lodge on your upcoming resort or marina project. Whether you're seeking excellence in design, construction, or sustainable development, we're here to make your project a success.
</p>
<a href="./contact-us.php">Contact Us</a>

  </div>
</div>

<footer>
  <p id="copyright">Copyright &copy; <?php echo date("Y"); ?> Moffat Bay Lodge</p>
</footer>

</div>

</body>
</html>
