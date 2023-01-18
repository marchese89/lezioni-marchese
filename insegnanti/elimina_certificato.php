<?php

include '../config/mysql-config.php';

$numero = $_GET['n'];

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES certificati WRITE");
$conn->query("BEGIN");

$result = $conn->query("SELECT * FROM certificati WHERE numero = '$numero'");
$certificato = $result->fetch_assoc();
$percorso_file =  $certificato['percorso'];

$res = $conn->query("DELETE FROM certificati WHERE numero = '$numero'");

if ($res) {
    $conn->query("COMMIT");
    unlink("../" . $percorso_file);
} else {
    $conn->query("ROLLBACK");
}

$conn->query("UNLOCK TABLES");

header("Location: ../modifica-dati-insegnante.html");

?>