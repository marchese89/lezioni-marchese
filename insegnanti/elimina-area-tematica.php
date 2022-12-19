<?php 

include '../config/mysql-config.php';

$id = $_GET['id'];

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES area_tematica WRITE");
$conn->query("BEGIN");
$r = $conn->query("DELETE FROM area_tematica WHERE id='$id'");
if ($r) {
    $conn->query("COMMIT");
} else {
    $conn->query("ROLLBACK");
}
$conn->query("UNLOCK TABLES");
header("Location: ../nuova-area-tematica.html")

?>