<?php 
include_once '../config/mysql-config.php';
include_once '../script/funzioni-php.php';

session_start();

$id = $_POST['id'];

$svolgimento = $_SESSION['percorsoPDF_SL'];
$insegnante = trovaIdInsegnante($_SESSION['user'],$conn);

//troviamo l'id della soluzione precedente
$result = $conn->query("SELECT * FROM svolgimento_lezioni WHERE richiesta='$id' AND ins='$insegnante'");
$svolg = $result->fetch_assoc();
$id_svolg = $svolg['id'];


unlink("../" . $svolg['svolgimento']);

$conn->query("UPDATE svolgimento_lezioni SET svolgimento = '$svolgimento' WHERE id = '$id_svolg'");

unset($_SESSION['percorsoPDF_SL']);
unset($_SESSION['pdfSLCaricato']);

header("Location: ../visualizza-richiesta-lezione-i-". $id .".html");

?>