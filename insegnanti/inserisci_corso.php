<?php 
include '../config/mysql-config.php';
include '../script/funzioni-php.php';
session_start();
$materia =  $_POST['materia'];
$corso = $_POST['nome_corso'];
$insegnante = trovaIdInsegnante($_SESSION['user'],$conn);

$result = $conn->query("INSERT INTO corso(nome,materia,insegnante) VALUES ('$corso','$materia','$insegnante')");

header("Location: ../nuovo-corso.html");
?>