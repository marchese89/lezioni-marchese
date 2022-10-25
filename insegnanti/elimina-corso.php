<?php 

include '../config/mysql-config.php';

$id = $_GET['id'];

$conn->query("DELETE FROM corso WHERE id='$id'");

header("Location: ../nuovo-corso.html")

?>