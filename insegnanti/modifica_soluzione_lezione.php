<?php 
include_once '../config/mysql-config.php';
include_once '../script/funzioni-php.php';

session_start();

$id = $_POST['id'];

$svolgimento = $_SESSION['percorsoPDF_SL'];

//troviamo l'id della soluzione precedente
$result = $conn->query("SELECT * FROM richieste_lezioni WHERE id = '$id'");
$richiesta = $result->fetch_assoc();
$id_richiesta = $richiesta['id'];


unlink("../" . $richiesta['svolgimento']);

$conn->query("UPDATE richieste_lezioni SET svolgimento = '$svolgimento' WHERE id = '$id_richiesta'");

unset($_SESSION['percorsoPDF_SL']);
unset($_SESSION['pdfSLCaricato']);

header("Location: ../visualizza-richiesta-lezione-i-". $id .".html");

?>