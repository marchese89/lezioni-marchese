<?php 
include '../config/mysql-config.php';
include '../script/funzioni-php.php';
session_start();
$materia =  $_POST['materia'];
$corso = $_POST['nome_corso'];

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES corso WRITE");
$conn->query("BEGIN");
$r = $conn->query("INSERT INTO corso(nome,materia) VALUES ('$corso','$materia')");
if ($r) {
    $conn->query("COMMIT");
} else {
    $conn->query("ROLLBACK");
}
$conn->query("UNLOCK TABLES");
header("Location: ../nuovo-corso.html");
?>