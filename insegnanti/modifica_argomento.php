<?php


include '../config/mysql-config.php';

$id = $_POST['id'];
$nome_arg = $_POST['nome_argomento'];

$conn->query("UPDATE argomento SET nome='$nome_arg' WHERE id='$id'");

header("Location: ../nuovo-argomento.html");
?>