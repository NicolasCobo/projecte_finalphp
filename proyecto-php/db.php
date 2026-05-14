<?php
$host = "db";
$usuari = "root";
$passwd = "root";
$basedades = "biblioteca";
$conn = mysqli_connect($host, $usuari, $passwd, $basedades);
if (!$conn) {
die("Error de connexió: " . mysqli_connect_error());
}
?>