<?php 

include '../config/mysql-config.php';

$id = $_GET['id'];
mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES corso WRITE");
$conn->query("BEGIN");
$r = $conn->query("DELETE FROM corso WHERE id='$id'");
if ($r) {
    $conn->query("COMMIT");
} else {
    $conn->query("ROLLBACK");
}
$conn->query("UNLOCK TABLES");

header("Location: ../nuovo-corso.html")

?>