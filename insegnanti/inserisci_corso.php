<?php 
include '../config/mysql-config.php';

$materia =  $_POST['materia'];
$corso = $_POST['nome_corso'];

$result = $conn->query("INSERT INTO corso(nome,materia) VALUES ('$corso','$materia')");

header("Location: ../nuovo-corso.html");
?>