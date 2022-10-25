<?php 

include '../config/mysql-config.php';

$id = $_POST['id'];
$nome = $_POST['area_tem'];
$conn->query("UPDATE area_tematica set nome='$nome' WHERE id='$id'");

header("Location: ../nuova-area-tematica.html")

?>