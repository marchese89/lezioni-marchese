<?php 
include_once '../config/mysql-config.php';
include_once '../script/funzioni-php.php';

session_start();

$id = $_POST['id'];
$prezzo = $_POST['prezzo_s'];

$insegnante = trovaIdInsegnante($_SESSION['user'],$conn);

//troviamo l'id della soluzione precedente
$result = $conn->query("SELECT * FROM svolgimento_lezioni WHERE richiesta='$id' AND ins='$insegnante'");
$svolg = $result->fetch_assoc();
$id_svolg = $svolg['id'];



unset($path);

$conn->query("UPDATE svolgimento_lezioni SET  prezzo = '$prezzo' WHERE id = '$id_svolg'");


header("Location: ../visualizza-richiesta-lezione-i-". $id .".html");

?>