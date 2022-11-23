<?php 
include_once '../config/mysql-config.php';
include_once '../script/funzioni-php.php';

session_start();

$id = $_POST['id'];
$prezzo = $_POST['prezzo_s'];

$svolgimento = $_SESSION['percorsoPDF_SL'];


$conn->query("UPDATE richieste_lezioni SET svolgimento = '$svolgimento', prezzo = '$prezzo' WHERE id = '$id'");

unset($_SESSION['percorsoPDF_SL']);
unset($_SESSION['pdfSLCaricato']);

header("Location: ../visualizza-richiesta-lezione-i-". $id .".html");

?>