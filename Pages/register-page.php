<!-- 
CSD 460 Capstone Project
Orange Group 2023
Amanda Sherman
Caleb Rummel
Karendaysu Wolfe
Robin Pindel

Groundwork code referenced from https://code.tutsplus.com/create-a-php-login-form--cms-33261t.
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
  <a href="./landing-page.php"><img src="./images/mbl2.jpeg" alt="Moffat Bay Lodge image" id="banner"></a>
  <a href="./landing-page.php"><div id="mblname"><h1>Moffat Bay Lodge</h1></div></a>
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

<?php
    function redirect($url) {
      header('Location: '.$url);
      die();
    }
    
    if (isset($_POST['register'])) {
        $email = $_POST['email'];
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $telephone = $_POST['telephone'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $query = $connection->prepare("SELECT * FROM customer WHERE email=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
          echo '<p class="error">The email address is already registered!</p>';
        }
        elseif ($query->rowCount() == 0 && ($password == $confirmpassword)) {
            $query = $connection->prepare("INSERT INTO customer(email,firstname,
            lastname,telephone,password) VALUES (:email,:firstname,:lastname,:telephone,:password_hash)");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->bindParam("firstname", $fname, PDO::PARAM_STR);
            $query->bindParam("lastname", $lname, PDO::PARAM_STR);
            $query->bindParam("telephone", $telephone, PDO::PARAM_STR);
            $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
            $result = $query->execute();
            if ($result) {
                echo '<p class="success">Your registration was successful!</p>';
                echo "<a href=\"login-page.php\" id=\"login\">Log In Now</a>";
            } else {
                echo '<p class="error">Something went wrong!</p>';
            }
        }
        else {
          echo '<p class="error">The entered passwords do not match!</p>';
        }
    }
?>

<script>
  var redirect = function(){
   document.location.href="./landing-page.php"
}
</script>

<form class="register" method="post" action="" name="signup-form">
  <fieldset>
    <legend>ACCOUNT SIGN UP</legend>
  <div class="form-element">
    <label class="reg">Email Address *</label>
    <input type="email" name="email" placeholder="test@domain.com" class="register-fields" required />
  </div>
  <div class="form-element">
    <label class="reg">First Name *</label>
    <input type="text" name="firstname" placeholder="i.e. John" class="register-fields" required />
  </div>
  <div class="form-element">
    <label class="reg">Last Name *</label>
    <input type="text" name="lastname" placeholder="i.e. Smith" class="register-fields" required />
  </div>
  <div class="form-element">
    <label class="reg">Telephone</label>
    <input type="tel" name="telephone" class="register-fields"
      pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890" />
  </div>
  <div class="form-element">
    <label class="reg">Password *</label>
    <input type="password" name="password" placeholder="Please enter password" 
    pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])\S*$" required />
  </div>
  <div class="form-element">
    <label class="reg">Confirm Password *</label>
    <input type="password" name="confirmpassword" placeholder="Please confirm password" required />
  </div>
  <button class="reg" type="reset" name="cancel" value="cancel" onclick="redirect()">Cancel</button>
  <button class="reg" type="submit" name="register" value="register">Submit</button>
  <p>* indicates the field is required</p>
  <p>Passwords need to be at least 8 characters long and contain at least one uppercase letter and one lowercase letter.</p>  
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