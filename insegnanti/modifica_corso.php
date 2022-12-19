<?php 

include '../config/mysql-config.php';

$id = $_POST['id'];
$nome = $_POST['nome_corso2'];

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES corso WRITE");
$conn->query("BEGIN");

$r = $conn->query("UPDATE corso set nome='$nome' WHERE id='$id'");

if ($r) {
    $conn->query("COMMIT");
} else {
    $conn->query("ROLLBACK");
}
$conn->query("UNLOCK TABLES");

header("Location: ../nuovo-corso.html")

?>