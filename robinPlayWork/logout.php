<?php
session_start();
session_destroy();

function redirect($url) {
  header('Location: '.$url);
  die();
}

redirect("sessionTest.php");
?>