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

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES esercizio WRITE");
$conn->query("BEGIN");
$r = $conn->query("INSERT INTO esercizio(titolo,traccia,svolgimento,corso_ex,prezzo,insegn) VALUES ('$titolo','$traccia','$svolgimento','$corso','$prezzo','$id_ins')");

if ($r) {
    unset($_SESSION['percorsoPDF_TE']);
    unset($_SESSION['percorsoPDF_SE']);
    $conn->query("COMMIT");
} else {
    $conn->query("ROLLBACK");
}
$conn->query("UNLOCK TABLES");


header("Location: ../corso-ins-". $corso . ".html");
?>