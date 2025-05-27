<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="AkebiGC";


$conn = mysqli_connect ($servername, $username, $password, $dbname) or die ('Không thể kết nối tới database');
mysqli_set_charset($conn, 'UTF8');


