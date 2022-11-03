<?php

include '../config/mysql-config.php';

$id = $_POST['id'];
$titolo = $_POST['titolo_lezione'];
$numero = $_POST['numero_lezione'];
$prezzo_lezione = $_POST['prezzo_lezione'];

$result = $conn->query("SELECT * FROM lezione WHERE id='$id'");
$lezione = $result->fetch_assoc();

$conn->query("UPDATE lezione SET titolo='$titolo', numero='$numero', prezzo ='$prezzo_lezione'  WHERE id='$id'");

header("Location: ../modifica-lezione-". $id .".html");
?>