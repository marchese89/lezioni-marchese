<?php
include '../config/mysql-config.php';

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM lezione WHERE id='$id'");
$argomento = $result->fetch_assoc();

unlink("../" . $argomento['percorso_file']);

$conn->query("DELETE FROM lezione  WHERE id='$id'");

header("Location: ../nuova-lezione.html");
?>