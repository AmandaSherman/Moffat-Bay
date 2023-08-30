<!--
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
  <a href="../reservation-lookup-code.php">Look Up Reservation</a>
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
    <a href="#">Reserve</a>
  </div>
  <div id="nav2">
    <a href="#">Attractions</a>
  </div>
  <div id="nav3">
    <a href="#">About Us</a>
  </div>
  <div id="nav4">
    <a href="#">Contact Us</a>
  </div>
</div>
<div id="content-container">
  <p><h1>Welcome Content</h1></p>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus mattis rhoncus urna neque viverra justo nec. Praesent semper feugiat nibh sed pulvinar proin gravida hendrerit lectus. Laoreet id donec ultrices tincidunt arcu non sodales neque. Vitae et leo duis ut diam. Ac auctor augue mauris augue. Duis at consectetur lorem donec massa sapien faucibus et molestie. Aliquam nulla facilisi cras fermentum odio eu feugiat pretium. Rutrum tellus pellentesque eu tincidunt. Amet mattis vulputate enim nulla aliquet porttitor lacus luctus. Elementum tempus egestas sed sed risus pretium quam. Velit scelerisque in dictum non consectetur a erat. In nisl nisi scelerisque eu ultrices. Amet luctus venenatis lectus magna fringilla urna. Metus aliquam eleifend mi in nulla posuere sollicitudin aliquam ultrices.</p>
</div>
<footer>
  <p id="copyright">Copyright &copy; <script>document.write(new Date().getFullYear())</script>
    Moffat Bay Lodge</p>
</footer>

</div>

</body>
</html>