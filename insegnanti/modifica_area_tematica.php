<?php 

include '../config/mysql-config.php';

$id = $_POST['id'];
$nome = $_POST['area_tem'];
mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES area_tematica WRITE");
$conn->query("BEGIN");

$r = $conn->query("UPDATE area_tematica set nome='$nome' WHERE id='$id'");

if ($r) {
    $conn->query("COMMIT");
} else {
    $conn->query("ROLLBACK");
}
$conn->query("UNLOCK TABLES");

header("Location: ../nuova-area-tematica.html")

?>