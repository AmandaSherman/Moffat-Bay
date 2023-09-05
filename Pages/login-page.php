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
  <a href="./about-us.php">About Us</a>
  </div>
</div>

<div id="content-container">

<?php
    function redirect($url) {
      header('Location: '.$url);
      die();
    }

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = $connection->prepare("SELECT * FROM customer WHERE email=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            echo '<p class="error">Email address and password combination is incorrect!</p>';
        } else {
            if (password_verify($password, $result['password'])) {
                $_SESSION['customerid'] = $result['customerid'];
                #echo '<p class="success">Congratulations, you are logged in!</p>';
                redirect("./landing-page.php");
            } else {
                echo '<p class="error">Email address and password combination is incorrect!</p>';
            }
        }
    }
?>

<form method="post" action="" name="signin-form">
  <fieldset>
    <legend>LOGIN</legend>
  <div class="form-element" id="email-input">
    <label class="login">Email Address</label>
  </div>
  <div class="form-element" id="email-input">
    <input type="email" name="email" placeholder="Email Address" 
      placeholder="Email Address" required />
  </div>
  <div class="form-element">
    <label class="login">Password</label>
  </div>
  <div class="form-element">
    <input type="password" name="password" placeholder="Password" required />
  </div>
  <button type="submit" name="login" value="login">Log In</button>
  </fieldset>
</form>

</div>

<footer>
  <p id="copyright">Copyright &copy; <script>document.write(new Date().getFullYear())</script>
    Moffat Bay Lodge</p>
</footer>

</div>

</body>
</html>