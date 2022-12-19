<?php 

include '../config/mysql-config.php';

$id = $_POST['id'];
$nome = $_POST['materia2'];

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES materia WRITE");
$conn->query("BEGIN");

$r = $conn->query("UPDATE materia set nome='$nome' WHERE id='$id'");

if ($r) {
    $conn->query("COMMIT");
} else {
    $conn->query("ROLLBACK");
}
$conn->query("UNLOCK TABLES");

header("Location: ../nuova-materia.html")

?>