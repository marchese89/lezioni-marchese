<?php 

include '../config/mysql-config.php';

$id = $_POST['id'];
$nome = $_POST['materia2'];
$conn->query("UPDATE materia set nome='$nome' WHERE id='$id'");

header("Location: ../nuova-materia.html")

?>