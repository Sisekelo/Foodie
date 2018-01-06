<?php
/* Database connection settings */
$host = 'mysql.hostinger.com';
$user = 'u627368589_root';
$pass = '101morema!';
$db = 'u627368589_one';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);