<head>
  <link href="./loginsu.css" type="text/css" rel="stylesheet">
</head>

<?php
    session_start();
    include('db-config.php');
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
        if ($query->rowCount() == 0 && ($password == $confirmpassword)) {
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
            } else {
                echo '<p class="error">Something went wrong!</p>';
            }
        }
        else {
          echo '<p class="error">The entered passwords do not match!</p>';
        }
    }
?>

<form method="post" action="" name="signup-form">
  <div class="form-element">
    <label>Email Address</label>
    <input type="email" name="email" placeholder="i.e. test@domain.com" required />
  </div>
  <div class="form-element">
    <label>First Name</label>
    <input type="text" name="firstname" placeholder="i.e. John" required />
  </div>
  <div class="form-element">
    <label>Last Name</label>
    <input type="text" name="lastname" placeholder="i.e. Smith" required />
  </div>
  <div class="form-element">
    <label>Telephone</label>
    <input type="tel" name="telephone" 
      pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890" required />
  </div>
  <div class="form-element">
    <label>Password</label>
    <input type="password" name="password" placeholder="8+ chars, 1 upper and 1 lower" 
    pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])\S*$" required />
  </div>
  <div class="form-element">
    <label>Confirm Password</label>
    <input type="password" name="confirmpassword" placeholder="Please confirm password" required />
  </div>
  <button type="submit" name="register" value="register">Register</button>
</form>