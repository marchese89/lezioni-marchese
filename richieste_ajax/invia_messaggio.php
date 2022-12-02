<?php 
session_start();
date_default_timezone_set('Europe/Rome');
include '../config/mysql-config.php';
$data = date("Y-m-d H:i:s");
$id_prod = $_GET['id_prod'];
$tipo_prod =  $_GET['tipo_prod'];
$id_stud = $_GET['id_stud'];
$autore =  $_GET['aut'];//0->studente, 1->insegnante
$testo = str_replace("'", "''", $_GET['testo']);
$result = $conn->query("SELECT * FROM chat WHERE id_prodotto = '$id_prod' AND tipo_prodotto = '$tipo_prod' AND id_studente = '$id_stud'");
$chat = $result->fetch_assoc();
$id_chat = $chat['id'];
$conn->query("INSERT INTO messaggi_chat(id_chat,messaggio,autore,data) VALUES ('$id_chat','$testo','$autore','$data')");


?>