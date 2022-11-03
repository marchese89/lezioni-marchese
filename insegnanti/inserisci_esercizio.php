<?php 
session_start();

include '../config/mysql-config.php';

$titolo =  $_POST['titolo_esercizio'];
$argomento = $_POST['arg'];
$prezzo = $_POST['prezzo_esercizio'];
$traccia = $_SESSION['percorsoPDF_TE'];
$svolgimento = $_SESSION['percorsoPDF_SE'];

$email_ins = $_SESSION['user'];
$result0 = $conn->query("SELECT * FROM utente WHERE email='$email_ins'");
$row0 = $result0->fetch_assoc();
$id_ut = $row0['id'];

$result1 = $conn->query("SELECT * FROM insegnante WHERE utente_i='$id_ut'");
$row1 = $result1->fetch_assoc();
$id_ins = $row1['id'];

$result = $conn->query("INSERT INTO esercizio(titolo,traccia,svolgimento,argomento,prezzo,insegn) VALUES ('$titolo','$traccia','$svolgimento','$argomento','$prezzo','$id_ins')");

unset($_SESSION['percorsoPDF_TE']);
unset($_SESSION['percorsoPDF_SE']);

header("Location: ../nuovo-esercizio.html");
?>