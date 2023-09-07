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
  Moffat Bay Lodge (MBL) is your gateway to the stunning beauty of the San Juan Islands. Situated on Joviedsa Island, our lodge is part of a visionary project approved by the San Juan Islands First Nations Development Committee six months ago. The construction of both the lodge and marina is now in its final stages, and we're thrilled to be a part of this exciting development.
</p>

<p>
  At Moffat Bay Lodge, we've been entrusted with the responsibility of completing one of the two projects required before the facilities open to the public. Our mission is to ensure that the lodge is ready to offer a remarkable experience for our guests.
</p>

<h2>Why Choose MBL?</h2>
<p>
  Choosing Moffat Bay Lodge (MBL) for your San Juan Islands adventure is choosing excellence, sustainability, and cultural richness. Here are some reasons to make us your home away from home:
</p>
<ul>
  <li>San Juan Islands Beauty: Our location on Joviedsa Island offers a stunning natural backdrop, with breathtaking views of the San Juan Islands.</li>
  <li>Quality Accommodations: We take pride in providing top-notch lodging that blends comfort and luxury, ensuring you have a relaxing stay.</li>
  <li>Community and Culture: We embrace the heritage and culture of the San Juan Islands First Nations, making your stay a part of this rich history.</li>
  <li>Warm Hospitality: Our friendly staff is dedicated to making your experience unforgettable, offering personalized service to meet your every need.</li>
</ul>

<h2>Your San Juan Islands Retreat</h2>
<p>
  We invite you to experience the magic of Moffat Bay Lodge (MBL). Whether you're planning a family vacation, a romantic getaway, or an adventure with friends, we're here to make it extraordinary.
</p>
<a href="./reservation-page.php">Book Your Stay</a>

<h2>Contact Us</h2>

<!--Large chunks of contact form were taken from https://www.w3schools.com/howto/howto_css_contact_form.asp-->
<form action="send-email.php" method="post">

  <label for="fname">First Name</label>
  <input type="text" id="fname" name="firstname" require>

  <label for="lname">Last Name</label>
  <input type="text" id="lname" name="lastname" require>

  <label for="email">Email</label>
  <input type="email" id="email" name="email" require>

  <label for="lname">Phone Number</label>
  <input type="tel" id="phone" name="phone" require>

  <label for="message">Message</label>
  <textarea id="message" name="message" style="height:200px"></textarea>

  <input type="submit" value="Submit">

</form>


  </div>
</div>

<footer>
  <p id="copyright">Copyright &copy; <?php echo date("Y"); ?> Moffat Bay Lodge</p>
</footer>

</div>

</body>
</html>
