<?php
include '../config/mysql-config.php';

$id = $_GET['id'];

$conn->query("DELETE FROM argomento WHERE id='$id'");

header("Location: ../nuovo-argomento.html");
?>