<?php 
include '../config/mysql-config.php';

$corso =  $_POST['corso'];
$argomento = $_POST['nome_argomento'];

$result = $conn->query("INSERT INTO argomento(nome,corso_arg) VALUES ('$argomento','$corso')");

header("Location: ../nuovo-argomento.html");
?>