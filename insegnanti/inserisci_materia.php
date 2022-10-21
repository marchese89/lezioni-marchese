<?php 
include '../config/mysql-config.php';

$area_tematica = $_POST['area_tematica'];
$materia =  $_POST['materia'];

$result = $conn->query("INSERT INTO materia(nome,area_tematica) VALUES ('$materia','$area_tematica')");

header("Location: ../nuova-materia.html");
?>