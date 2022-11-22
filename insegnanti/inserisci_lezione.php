<?php 
session_start();

include '../config/mysql-config.php';

$titolo =  $_POST['titolo_lezione'];
$numero = $_POST['numero_lezione'];
$corso = $_POST['corso'];
$prezzo_lezione = $_POST['prezzo_lezione'];
$lezione = $_SESSION['percorsoPDF_L'];
$presentazione = $_SESSION['percorsoPDF_PL'];


$conn->query("INSERT INTO lezione(titolo,numero,corso_lez,presentazione,lezione,prezzo) VALUES ('$titolo','$numero','$corso','$presentazione','$lezione','$prezzo_lezione')");

unset($_SESSION['percorsoPDF_L']);
unset($_SESSION['percorsoPDF_PL']);

header("Location: ../nuova-lezione.html");
?>