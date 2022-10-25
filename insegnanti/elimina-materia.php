<?php 

include '../config/mysql-config.php';

$id = $_GET['id'];

$conn->query("DELETE FROM materia WHERE id='$id'");

header("Location: ../nuova-materia.html")

?>