<?php

  session_start();
  include('config.php');
  
  if (!array_key_exists('customerid',$_SESSION)) {
    echo "No one is logged in.";
  }
  else {
    $customerid = $_SESSION['customerid'];
    $query = $connection->prepare("SELECT email FROM customer WHERE customerid=:customerid");
    $query->bindParam("customerid", $customerid, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $email = $result['email'];
    echo "Session information: <br /><br />";
    echo "CustomerID = $customerid <br />";
    echo "Email Address = $email";
  }
?>

<br />
<br />
<a href="login.php">Log In</a>
<a href="logout.php">Log Out</a>