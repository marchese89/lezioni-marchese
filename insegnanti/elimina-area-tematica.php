<?php 

include '../config/mysql-config.php';

$id = $_GET['id'];

$conn->query("DELETE FROM area_tematica WHERE id='$id'");

header("Location: ../nuova-area-tematica.html")

?>