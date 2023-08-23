<!--<head>
  <link href="./loginsu.css" type="text/css" rel="stylesheet">
</head>-->

<form method="post" action="" name="reservation-lookup-form">
  <div class="form-element-left">
    <label>Email Address</label>
    <input type="email" name="email" placeholder="Email Address" 
      placeholder="Email Address" />
  </div>
  <div class="form-element-left">
    <label>Reservation ID</label>
    <input type="text" name="reservationid" placeholder="Reservation ID" />
  </div>
  <!--<input type="image" src="./images/search-glass.png" alt="reservation-lookup" width="20px" height="20px">-->
  <button type="submit" name="reservation-lookup" value="reservation-lookup">Lookup Reservation</button>
</form>

<?php  
  include('config.php');
  if (isset($_POST['reservation-lookup'])) {
    $email = $_POST['email'];
    $reservationid = $_POST['reservationid'];
    if (!$email && !$reservationid) {
      echo "Please provide an email address or reservation ID.";
    }
    elseif (!$email) {
      $query = $connection->prepare("SELECT * FROM reservations WHERE reservationid=:reservationid");
      $query->bindParam("reservationid", $reservationid, PDO::PARAM_STR);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_ASSOC);
      if (!$result) {
        echo '<p class="error">There is no reservation with this reservation ID.</p>';
      }
      else {
        foreach($result as $item => $detail) {
          echo "$item = $detail<br />";
        }
      }
    }
    elseif (!$reservationid) {
      $query = $connection->prepare("SELECT * FROM reservations WHERE email=:email");
      $query->bindParam("email", $email, PDO::PARAM_STR);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_ASSOC);
      if (!$result) {
        echo '<p class="error">There is no reservation with this email address.</p>';
      }
      else {
        foreach($result as $item => $detail) {
          echo "$item = $detail<br />";
        }
      }
    }
    else {
      $query = $connection->prepare("SELECT * FROM reservations WHERE email=:email AND reservationid=:reservationid");
      $query->bindParam("email", $email, PDO::PARAM_STR);
      $query->bindParam("reservationid", $reservationid, PDO::PARAM_STR);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_ASSOC);
      if (!$result) {
        echo '<p class="error">There is no reservation with this email address and reservation ID combination.</p>';
      }
      else {
        foreach($result as $item => $detail) {
          echo "$item = $detail<br />";
        }
      }
    }
  }
?>
