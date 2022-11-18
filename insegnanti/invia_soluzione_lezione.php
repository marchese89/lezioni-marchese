<?php 
include_once '../config/mysql-config.php';
include_once '../script/funzioni-php.php';

session_start();

$id = $_POST['id'];
$prezzo = $_POST['prezzo_s'];

$svolgimento = $_SESSION['percorsoPDF_SL'];
$insegnante = trovaIdInsegnante($_SESSION['user'],$conn);

$conn->query("INSERT INTO svolgimento_lezioni (richiesta,ins,svolgimento,prezzo) VALUES ('$id','$insegnante','$svolgimento','$prezzo')");

unset($_SESSION['percorsoPDF_SL']);
unset($_SESSION['pdfSLCaricato']);

header("Location: ../visualizza-richiesta-lezione-i-". $id .".html");

?>