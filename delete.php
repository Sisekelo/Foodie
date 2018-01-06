<?php
/* Displays all  notifications */
session_start();
require 'db.php';

$email = $_SESSION['email'];

$mysqli->query("DELETE FROM details WHERE email = '$email'");

header("location: index.php");

?>