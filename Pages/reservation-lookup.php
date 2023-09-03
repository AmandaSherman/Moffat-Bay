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

<!--<form name="reservation-lookup-form" action="" method ="post">
  <fieldset>
  <legend>Look Up Your Reservation</legend>
  <table id="#res-lookup">
    <tr>
      <td>
        <input class="lookup" type="email" name="email" placeholder="Email Address" 
        placeholder="Email Address" />
      </td>    
      <td>
        <label class="lookup">OR</label>
      </td>
      <td>
        <input class="lookup" type="text" name="reservationid" placeholder="Reservation ID" /> 
      </td>
      <td>
        <button class="lookup" type="submit" name="reservation-lookup" value="reservation-lookup"><img src="./images/search-glass.png" name="submit" width="26px" height="26px"></button>
      </td> 
    </tr>
  </table>
  </fieldset>
</form>-->

<!-- Responsive design removes table layout and uses divs-->
<form name="reservation-lookup-form" action="" method ="post">
  <fieldset>
  <legend>Look Up Your Reservation</legend>
  <div id="lookup-table-layout">
    <div class="lookup-table-layout">
      <input class="lookup" type="email" name="email" placeholder="Email Address" 
      placeholder="Email Address" />
    </div>
    <div class="lookup-table-layout">
      <label class="lookup">OR</label>
    </div>
    <div class="lookup-table-layout">
      <input class="lookup" type="text" name="reservationid" placeholder="Reservation ID" /> 
    </div>
    <div class="lookup-table-layout">  
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
      echo "<br />Please provide an email address or reservation ID.";
    }
    elseif (!$email) {
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
        foreach($result as $item => $detail) {
          echo "<p>$item = $detail</p>";
        }
      }
    }
    elseif (!$reservationid) {
      $query = $connection->prepare("SELECT customer.email, reservation.reservationid, reservation.customerid, reservation.checkin, reservation.checkout, reservation.numberguests, reservation.roomsize 
      FROM reservation, customer
      WHERE customer.customerid = reservation.customerid 
      AND customer.email = :email");
      $query->bindParam("email", $email, PDO::PARAM_STR);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_ASSOC);
      if (!$result) {
        echo '<br /><p class="error">There is no reservation with this email address.</p>';
      }
      else {
        echo "<h2>Your Reservation Details</h2>";
        foreach($result as $item => $detail) {
          echo "<p>$item = $detail</p>";
        }
      }
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
        foreach($result as $item => $detail) {
          echo "<p>$item = $detail</p>";
        }
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
