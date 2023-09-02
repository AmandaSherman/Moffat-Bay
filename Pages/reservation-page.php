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
<div id="res-table">
  <!--table for reservation-->
  <fieldset>
    <legend>BOOK YOUR VACATION</legend>
    <form action="reservation-review.php" method="post">
    <table>
      <tr>
        <td><input type="date" name="checkin" value="xxxx-xx-xx" required </td>
        <td><input type="date" name="checkout" value="xxxx-xx-xx" required </td>
        <td>
          <select name="number-guests" required>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
          </select>
        </td>
        <td>
          <select name="room-size" required>
              <option value=""></option>
              <option value="Double Full">Double Full</option>
              <option value="Queen">Queen</option>
              <option value="Double Queen">Double Queen</option>
              <option value="King">King</option>
          </select>
        </td>
      </tr>
      <tr>
        <td><label class="res">Check-In</label></td>
        <td><label class="res">Check-Out</label></td>
        <td><label class="res">Guests</label></td>
        <td><label class="res">Room Size</label></td>
      </tr>
    </table>
    <div class="form-element">
    <button type="submit" name="submit" value="submit">Submit</button>
    </div>    
    <p>(We'll review the details before the booking is finalized.)</p>
  </form>
  <div id="pricing">
    <h2 class="pricing">Pricing</h2>
    <p>Pricing is based on the number of guests as part of the reservation.</p>
    <ul>
      <li>1 - 2 guests: $120.75 per night</li>
      <li>3 - 5 guests: $157.50 per night</li>
      <li><b>Note:</b> 5 guests is the maximum allowed per room per night</li>
    </ul>
  </div>
  </fieldset>
</div>
</div>

<footer>
  <p id="copyright">Copyright &copy; <script>document.write(new Date().getFullYear())</script>
    Moffat Bay Lodge</p>
</footer>

</div>

</body>
</html>
