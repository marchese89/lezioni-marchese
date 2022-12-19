<?php
session_start();
date_default_timezone_set('Europe/Rome');
include_once '../config/mysql-config.php';
include_once '../script/funzioni-php.php';
$traccia = $_SESSION['percorsoPDF_RL'];
$studente = trovaIdStudente($_SESSION['user'], $conn);
$titolo = $_POST['titolo_l'];
$corso = $_POST['corso'];
$insegnante = trovaIdInsegnanteDaCorso($corso, $conn);
$data = date("Y-m-d H:i:s");
mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES richieste_lezioni WRITE");
$conn->query("BEGIN");
$r = $conn->query("INSERT INTO richieste_lezioni (titolo,studente,insegnante,traccia,data) VALUES ('$titolo','$studente','$insegnante','$traccia','$data')");
if ($r) {
    $conn->query("COMMIT");
    $conn->query("UNLOCK TABLES");
    unset($_SESSION['percorsoPDF_RL']);
    unset($_SESSION['pdfRLCaricato']);
    header("Location: ../richiesta-lezione-inserita.html");
} else {
    $conn->query("ROLLBACK");
    $conn->query("UNLOCK TABLES");
    header("Location: ../richiesta-lezione-fallita.html");
    
}

?>