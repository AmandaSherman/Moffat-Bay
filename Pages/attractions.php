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
  <p>
    Discover the myriad of attractions that MBL has to offer! From serene nature trails to exhilarating water sports, there's something for everyone.
  </p>
  
  <h2>Nature and Adventure</h2>
  <p>
    Immerse yourself in the beauty of nature and the thrill of adventure at MBL. Here are some of the attractions you can enjoy:
  </p>
  <ul>
    <li>Guided Nature Walks: Explore the scenic beauty of Moffat Bay with our experienced guides.</li>
    <li>Water Sports: Kayaking, canoeing, and paddleboarding on the pristine waters of the bay.</li>
    <li>Mountain Biking: Navigate through challenging terrains and enjoy breathtaking views.</li>
  </ul>

  <h2>Relaxation and Wellness</h2>
  <p>
    Looking for a more relaxed experience? MBL offers a range of wellness and relaxation attractions:
  </p>
  <ul>
    <li>Spa and Wellness Center: Indulge in rejuvenating treatments and massages.</li>
    <li>Yoga and Meditation Sessions: Find your inner peace amidst the serene surroundings.</li>
    <li>Beachside Lounging: Relax on our private beach and soak in the sun.</li>
  </ul>

  <h2>Local Attractions</h2>
  <p>
    Venture out and explore the local attractions around Moffat Bay. From local markets to cultural landmarks, there's plenty to see and do.
  </p>
  <a href="./reservation-page.php" id=>Reserve Now</a>

  </div>
</div>
<footer>
  <p id="copyright">Copyright &copy; <script>document.write(new Date().getFullYear())</script>
    Moffat Bay Lodge</p>
</footer>

</div>

</body>
</html>
