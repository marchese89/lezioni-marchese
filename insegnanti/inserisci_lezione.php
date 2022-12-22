<?php 
session_start();

include '../config/mysql-config.php';

$titolo =  $_POST['titolo_lezione'];
$numero = $_POST['numero_lezione'];
$corso = $_POST['corso'];
$prezzo_lezione = $_POST['prezzo_lezione'];
$lezione = $_SESSION['percorsoPDF_L'];
$presentazione = $_SESSION['percorsoPDF_PL'];

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES lezione WRITE");
$conn->query("BEGIN");
$r = $conn->query("INSERT INTO lezione(titolo,numero,corso_lez,presentazione,lezione,prezzo) VALUES ('$titolo','$numero','$corso','$presentazione','$lezione','$prezzo_lezione')");
if ($r) {
    unset($_SESSION['percorsoPDF_L']);
    unset($_SESSION['percorsoPDF_PL']);
    $conn->query("COMMIT");
} else {
    $conn->query("ROLLBACK");
}
$conn->query("UNLOCK TABLES");


header("Location: ../corso-ins-". $corso . ".html");
?>