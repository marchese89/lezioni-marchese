<?php 
session_start();

include '../config/mysql-config.php';

$nome = $_POST['area_tematica'];

$conn->query("INSERT INTO area_tematica(nome) VALUES('$nome')");

header("Location: ../nuova-area-tematica.html")

?>