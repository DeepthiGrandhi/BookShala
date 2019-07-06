<?php

$host = "localhost";
$user = "root";
$pass = "";
$database = "bookShaala";

$db = new mysqli($host, $user, $pass, $database) or die("Error: " . mysqli_error());