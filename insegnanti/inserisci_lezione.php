<?php 
session_start();

include '../config/mysql-config.php';

$titolo =  $_POST['titolo_lezione'];
$numero = $_POST['numero_lezione'];
$argomento = $_POST['argomento'];
$prezzo_lezione = $_POST['prezzo_lezione'];
$percorso_file = $_SESSION['percorsoPDF_L'];
$presentazione = $_SESSION['percorsoPDF_PL'];

$email_ins = $_SESSION['user'];
$result0 = $conn->query("SELECT * FROM utente WHERE email='$email_ins'");
$row0 = $result0->fetch_assoc();
$id_ut = $row0['id'];

$result1 = $conn->query("SELECT * FROM insegnante WHERE utente_i='$id_ut'");
$row1 = $result1->fetch_assoc();
$id_ins = $row1['id'];

$result = $conn->query("INSERT INTO lezione(titolo,numero,insegnante,arg_lez,presentazione,percorso_file,prezzo) VALUES ('$titolo','$numero','$id_ins','$argomento','$presentazione','$percorso_file','$prezzo_lezione')");

unset($_SESSION['percorsoPDF_L']);
unset($_SESSION['percorsoPDF_PL']);

header("Location: ../nuova-lezione.html");
?>