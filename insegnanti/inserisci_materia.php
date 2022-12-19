<?php 
include '../config/mysql-config.php';

$area_tematica = $_POST['area_tematica'];
$materia =  $_POST['materia'];

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES materia WRITE");
$conn->query("BEGIN");
$r = $conn->query("INSERT INTO materia(nome,area_tematica) VALUES ('$materia','$area_tematica')");
if ($r) {
    $conn->query("COMMIT");
} else {
    $conn->query("ROLLBACK");
}
$conn->query("UNLOCK TABLES");

header("Location: ../nuova-materia.html");
?>