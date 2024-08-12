<?php
global $conn;
$servername = "localhost";
$username = "root";
$password = "";
$conn = new PDO("mysql:host=$servername;dbname=asm1-php", $username, $password);
