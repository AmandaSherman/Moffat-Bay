<!-- 
CSD 460 Capstone Project
Orange Group 2023
Amanda Sherman
Caleb Rummel
Karendaysu Wolfe
Robin Pindel
-->


<?php
    define('USER', 'root');
    define('PASSWORD', 'root');
    define('HOST', 'localhost');
    define('DATABASE', 'moffat_bay');
    try {
        $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
?>