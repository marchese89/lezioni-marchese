<?php

include '../config/mysql-config.php';

$id = $_POST['id'];
$corso = $_GET['id_corso'];
$titolo = $_POST['titolo_lezione'];
$numero = $_POST['numero_lezione'];
$prezzo_lezione = $_POST['prezzo_lezione'];

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES lezione WRITE");
$conn->query("BEGIN");
$result = $conn->query("SELECT * FROM lezione WHERE id='$id'");
$lezione = $result->fetch_assoc();

$r = $conn->query("UPDATE lezione SET titolo='$titolo', numero='$numero', prezzo ='$prezzo_lezione'  WHERE id='$id'");

if ($r) {
    $conn->query("COMMIT");
} else {
    $conn->query("ROLLBACK");
}
$conn->query("UNLOCK TABLES");

header("Location: ../modifica-lezione-". $corso . "-"  . $id .".html");

?>