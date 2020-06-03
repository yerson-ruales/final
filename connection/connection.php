<?php
session_start();
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DB', 'tete');
$con=mysqli_connect(HOST,USER,PASSWORD,DB) or die(mysqli_connect_error());	
?>