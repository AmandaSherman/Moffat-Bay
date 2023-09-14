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
  
  // Set logged-in username at top of screen based on session details
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

<!-- Responsive design removes table layout and uses divs-->
<form name="reservation-lookup-form" action="" method ="post">
  <fieldset>
  <legend>Look Up Your Reservation</legend>
  <div id="lookup-table-layout">
    <div class="table-layout">
      <input class="lookup" type="email" name="email" placeholder="Email Address" 
      placeholder="Email Address" />
    </div>
    <div class="table-layout">
      <label class="lookup">OR</label>
    </div>
    <div class="table-layout">
      <input class="lookup" type="text" name="reservationid" placeholder="Reservation ID" /> 
    </div>
    <div class="table-layout">  
      <button class="lookup" type="submit" name="reservation-lookup" value="reservation-lookup"><img src="./images/search-glass.png" name="submit" width="20px" height="20px"></button>
    </div>
  </div>
  </fieldset>
</form>

<?php  
  if (isset($_POST['reservation-lookup'])) {
    $email = $_POST['email'];
    $reservationid = $_POST['reservationid'];
    if (!$email && !$reservationid) {
      echo "<br />Please provide an email address or reservation ID."; // User must provide either an email address, reservation id, or both
    }
    elseif (!$email) { // Reservation lookup using reservation id
      $query = $connection->prepare("SELECT customer.email, reservation.reservationid, reservation.customerid, reservation.checkin, reservation.checkout, reservation.numberguests, reservation.roomsize 
      FROM reservation, customer
      WHERE customer.customerid = reservation.customerid 
      AND reservation.reservationid=:reservationid");
      $query->bindParam("reservationid", $reservationid, PDO::PARAM_STR);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_ASSOC);
      if (!$result) {
        echo '<br /><p class="error">There is no reservation with this reservation ID.</p>';
      }
      else {
        echo "<h2>Your Reservation Details</h2>";
        echo "<label>Email Address:</label>";?>&emsp;<?PHP
        echo htmlspecialchars($result["email"]);
        echo "<br />";
        echo "<label>Reservation ID:</label>";?>&emsp;<?PHP
        echo htmlspecialchars($result["reservationid"]);
        echo "<br />";
        echo "<label>Check-In Date:</label>";?>&emsp;<?PHP
        echo htmlspecialchars($result["checkin"]);
        echo "<br />";
        echo "<label>Check-Out Date:</label>";?>&emsp;<?PHP
        echo htmlspecialchars($result["checkout"]);
        echo "<br />";
        echo "<label>Number of Guests:</label>";?>&emsp;<?PHP
        echo htmlspecialchars($result["numberguests"]);
        echo "<br />";
        echo "<label>Roomsize:</label>";?>&emsp;<?PHP
        echo htmlspecialchars($result["roomsize"]);
        echo "<br />";
        $diffcheckin = date_create($result["checkin"]);
        $diffcheckout = date_create($result["checkout"]);
        $interval = date_diff($diffcheckin, $diffcheckout);
        $numbernights = $interval->format("%a");

        // Database query version of price checking
        $price;
        $numberguests = $result["numberguests"];
        $query = $connection->prepare("SELECT cost FROM price WHERE numberguests=:numberguests");
        $query->bindParam("numberguests", $numberguests, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $price = $numbernights * $result['cost'];

        echo "<label>Cost:</label>";?>&emsp;<?PHP
        echo "$" . htmlspecialchars(number_format((float)$price, 2, '.', ''));
      }
    }
    elseif (!$reservationid) {  // Reservation lookup using email address
      $query = $connection->prepare("SELECT customer.email, reservation.reservationid, reservation.customerid, reservation.checkin, reservation.checkout, reservation.numberguests, reservation.roomsize 
      FROM reservation, customer
      WHERE customer.customerid = reservation.customerid 
      AND customer.email = :email");
      $query->bindParam("email", $email, PDO::PARAM_STR);
      $query->execute();
      //$result = $query->fetch(PDO::FETCH_ASSOC);  // Single reservation returned for email address search
      $result = $query->fetchAll(PDO::FETCH_ASSOC);
      $rowCount = $query->rowCount();

      if (!$result) {
        echo '<br /><p class="error">There is no reservation with this email address.</p>';
      }
      else {
        echo "<h2>Your Reservation Details</h2>";
        for ($i = 0; $i <= ($rowCount - 1); $i++) {
          echo "<label>Email Address:</label>";?>&emsp;<?PHP
          echo htmlspecialchars($result[$i]["email"]);
          echo "<br />";
          echo "<label>Reservation ID:</label>";?>&emsp;<?PHP
          echo htmlspecialchars($result[$i]["reservationid"]);
          echo "<br />";
          echo "<label>Check-In Date:</label>";?>&emsp;<?PHP
          echo htmlspecialchars($result[$i]["checkin"]);
          echo "<br />";
          echo "<label>Check-Out Date:</label>";?>&emsp;<?PHP
          echo htmlspecialchars($result[$i]["checkout"]);
          echo "<br />";
          echo "<label>Number of Guests:</label>";?>&emsp;<?PHP
          echo htmlspecialchars($result[$i]["numberguests"]);
          echo "<br />";
          echo "<label>Roomsize:</label>";?>&emsp;<?PHP
          echo htmlspecialchars($result[$i]["roomsize"]);
          echo "<br />";
          $diffcheckin = date_create($result[$i]["checkin"]);
          $diffcheckout = date_create($result[$i]["checkout"]);
          $interval = date_diff($diffcheckin, $diffcheckout);
          $numbernights = $interval->format("%a");
          if ($result[$i]["numberguests"] == 1 || $result[$i]["numberguests"] == 2) {
            $price = 120.75 * $numbernights;
          }
          else {
            $price = 157.50 * $numbernights;
          }
          echo "<label>Cost:</label>";?>&emsp;<?PHP
          echo "$" . htmlspecialchars(number_format((float)$price, 2, '.', ''));
          echo "<br /><br />";
        }
      } 
      // Result display for email address search that only returns the first row
      /*if (!$result) {
        echo '<br /><p class="error">There is no reservation with this email address.</p>';
      }
      else {
        echo "<h2>Your Reservation Details</h2>";
        echo "<label>Email Address:</label>";?>&emsp;<?PHP
        echo htmlspecialchars($result["email"]);
        echo "<br />";
        echo "<label>Reservation ID:</label>";?>&emsp;<?PHP
        echo htmlspecialchars($result["reservationid"]);
        echo "<br />";
        echo "<label>Check-In Date:</label>";?>&emsp;<?PHP
        echo htmlspecialchars($result["checkin"]);
        echo "<br />";
        echo "<label>Check-Out Date:</label>";?>&emsp;<?PHP
        echo htmlspecialchars($result["checkout"]);
        echo "<br />";
        echo "<label>Number of Guests:</label>";?>&emsp;<?PHP
        echo htmlspecialchars($result["numberguests"]);
        echo "<br />";
        echo "<label>Roomsize:</label>";?>&emsp;<?PHP
        echo htmlspecialchars($result["roomsize"]);
        echo "<br />";
        $diffcheckin = date_create($result["checkin"]);
        $diffcheckout = date_create($result["checkout"]);
        $interval = date_diff($diffcheckin, $diffcheckout);
        $numbernights = $interval->format("%a");
        if ($result["numberguests"] == 1 || $result["numberguests"] == 2) {
          $price = 120.75 * $numbernights;
        }
        else {
          $price = 157.50 * $numbernights;
        }
        echo "<label>Cost:</label>";?>&emsp;<?PHP
        echo "$" . htmlspecialchars($price);
      }*/
    }
    else {
      $query = $connection->prepare("SELECT customer.email, reservation.reservationid, reservation.customerid, reservation.checkin, reservation.checkout, reservation.numberguests, reservation.roomsize 
      FROM reservation, customer
      WHERE customer.customerid = reservation.customerid
      AND reservation.reservationid = :reservationid;
      AND customer.email = :email");
      $query->bindParam("email", $email, PDO::PARAM_STR);
      $query->bindParam("reservationid", $reservationid, PDO::PARAM_STR);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_ASSOC);
      if (!$result) {
        echo '<br /><p class="error">There is no reservation with this email address and reservation ID combination.</p>';
      }
      else {
        echo "<h2>Your Reservation Details</h2>";
        echo "<label>Email Address:</label>";?>&emsp;<?PHP
        echo htmlspecialchars($result["email"]);
        echo "<br />";
        echo "<label>Reservation ID:</label>";?>&emsp;<?PHP
        echo htmlspecialchars($result["reservationid"]);
        echo "<br />";
        echo "<label>Check-In Date:</label>";?>&emsp;<?PHP
        echo htmlspecialchars($result["checkin"]);
        echo "<br />";
        echo "<label>Check-Out Date:</label>";?>&emsp;<?PHP
        echo htmlspecialchars($result["checkout"]);
        echo "<br />";
        echo "<label>Number of Guests:</label>";?>&emsp;<?PHP
        echo htmlspecialchars($result["numberguests"]);
        echo "<br />";
        echo "<label>Roomsize:</label>";?>&emsp;<?PHP
        echo htmlspecialchars($result["roomsize"]);
        echo "<br />";
        $diffcheckin = date_create($result["checkin"]);
        $diffcheckout = date_create($result["checkout"]);
        $interval = date_diff($diffcheckin, $diffcheckout);
        $numbernights = $interval->format("%a");
        if ($result["numberguests"] == 1 || $result["numberguests"] == 2) {
          $price = 120.75 * $numbernights;
        }
        else {
          $price = 157.50 * $numbernights;
        }
        echo "<label>Cost:</label>";?>&emsp;<?PHP
        echo "$" . htmlspecialchars(number_format((float)$price, 2, '.', ''));
      }
    }
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