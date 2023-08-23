<?php

  session_start();
  include('config.php');
  
  if (!array_key_exists('userid',$_SESSION)) {
    echo "No one is logged in.";
  }
  else {
    $userid = $_SESSION['userid'];
    $query = $connection->prepare("SELECT email FROM useraccounts WHERE userid=:userid");
    $query->bindParam("userid", $userid, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $email = $result['email'];
    echo "Session information: <br /><br />";
    echo "UserID = $userid <br />";
    echo "Email Address = $email";
  }
?>

<br />
<br />
<a href="login.php">Log In</a>
<a href="logout.php">Log Out</a>