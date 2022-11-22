<?php 
session_start();

include '../config/mysql-config.php';
include '../script/funzioni-php.php';

$id_ins = trovaIdInsegnante($_SESSION['user'],$conn);

$titolo =  $_POST['titolo_esercizio'];
$corso = $_POST['corso'];
$prezzo = $_POST['prezzo_esercizio'];
$traccia = $_SESSION['percorsoPDF_TE'];
$svolgimento = $_SESSION['percorsoPDF_SE'];

$result = $conn->query("INSERT INTO esercizio(titolo,traccia,svolgimento,corso_ex,prezzo,insegn) VALUES ('$titolo','$traccia','$svolgimento','$corso','$prezzo','$id_ins')");

unset($_SESSION['percorsoPDF_TE']);
unset($_SESSION['percorsoPDF_SE']);

header("Location: ../nuovo-esercizio.html");
?>