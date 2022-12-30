<?php

include '../config/mysql-config.php';

$id = $_POST['id'];
$corso = $_GET['id_corso'];
$titolo = $_POST['titolo_esercizio'];
$prezzo_esercizio = $_POST['prezzo_esercizio'];

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES esercizio WRITE");
$conn->query("BEGIN");

$r = $conn->query("UPDATE esercizio SET titolo='$titolo', prezzo ='$prezzo_esercizio'  WHERE id='$id'");

if ($r) {
    $conn->query("COMMIT");
} else {
    $conn->query("ROLLBACK");
}
$conn->query("UNLOCK TABLES");

header("Location: ../modifica-esercizio-ins-". $corso . "-"  . $id .".html");

?>