<?php
include '../config/mysql-config.php';

$id = $_GET['id'];
$corso = $_GET['id_corso'];
$result = $conn->query("SELECT * FROM lezione WHERE id='$id'");
$lezione = $result->fetch_assoc();


mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES lezione WRITE");
$conn->query("BEGIN");
$r = $conn->query("DELETE FROM lezione  WHERE id='$id'");
if ($r) {
    unlink("../" . $lezione['presentazione']);
    unlink("../" . $lezione['lezione']);
    $conn->query("COMMIT"); 
} else {
    $conn->query("ROLLBACK");
}
$conn->query("UNLOCK TABLES");

header("Location: ../corso-ins-". $corso .".html.html");
?>