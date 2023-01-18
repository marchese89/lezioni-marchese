<?php
session_start();
include '../config/mysql-config.php';

$percorso = $_SESSION['percorsoPDF_CV'];
$numero = $_POST['num_cert'];
$nome = str_replace("'", "''", $_POST['titolo_c']);
mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES certificati WRITE");
$conn->query("BEGIN");
$res = $conn->query("INSERT INTO certificati(nome,numero,percorso) VALUES ('$nome','$numero','$percorso')");
if ($res) {
    $conn->query("COMMIT");
    unset($_SESSION['percorsoPDF_CV']);
    unset($_SESSION['pdfCVCaricato']);
} else {
    $conn->query("ROLLBACK");
}

$conn->query("UNLOCK TABLES");

if ($res) {
    header("Location: ../modifica-dati-insegnante.html");
}else{
    header("Location: ../nuovo-certificato2.html");
}