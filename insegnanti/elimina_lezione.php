<?php
include '../config/mysql-config.php';

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM lezione WHERE id='$id'");
$lezione = $result->fetch_assoc();

unlink("../" . $lezione['presentazione']);
unlink("../" . $lezione['lezione']);

$conn->query("DELETE FROM lezione  WHERE id='$id'");

header("Location: ../nuova-lezione.html");
?>