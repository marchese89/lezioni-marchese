<?php 
session_start();

include '../config/mysql-config.php';

$nome = $_POST['area_tematica'];

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES area_tematica WRITE");
$conn->query("BEGIN");
$r = $conn->query("INSERT INTO area_tematica(nome) VALUES('$nome')");
if ($r) {
    $conn->query("COMMIT");
} else {
    $conn->query("ROLLBACK");
}
$conn->query("UNLOCK TABLES");
header("Location: ../nuova-area-tematica.html")

?>