<?php 
include 'carrello.php';
include '../config/mysql-config.php';

session_start();
echo 'session start<br>';
$id = $_GET['id'];
$tipo = $_GET['tipo'];

$carrello = $_SESSION['carrello'];

$carrello->rimuovi($id,$tipo);


header("Location: ../carrello.html");

?>