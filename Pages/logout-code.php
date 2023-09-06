<!-- 
CSD 460 Capstone Project
Orange Group 2023
Amanda Sherman
Caleb Rummel
Karendaysu Wolfe
Robin Pindel
-->


<?php
session_start();
session_destroy();

function redirect($url) {
  header('Location: '.$url);
  die();
}

redirect("./landing-page.php");
?>