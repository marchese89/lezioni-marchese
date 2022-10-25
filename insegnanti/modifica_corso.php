<?php 

include '../config/mysql-config.php';

$id = $_POST['id'];
$nome = $_POST['nome_corso2'];
$conn->query("UPDATE corso set nome='$nome' WHERE id='$id'");

header("Location: ../nuovo-corso.html")

?>