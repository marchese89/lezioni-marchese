<?php
session_start();

include '../config/mysql-config.php';

$id_prod = $_GET['id_prod'];
$tipo_prod = $_GET['tipo_prod'];
$id_stud = $_GET['id_stud'];
$testo = str_replace("'", "''", $_GET['testo']);

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES feedback WRITE");
$conn->query("BEGIN");
$result;
$result0 = $conn->query("SELECT * FROM feedback WHERE prodotto = '$id_prod' AND tipo_prodotto = '$tipo_prod' AND studente = '$id_stud'");
if ($result0->num_rows > 0) {
    $result = $conn->query("UPDATE feedback SET recensione = '$testo' WHERE prodotto = '$id_prod' AND tipo_prodotto = '$tipo_prod' AND studente = '$id_stud'");
} else {
    $result = $conn->query("INSERT INTO feedback(studente,prodotto,tipo_prodotto,recensione) VALUES('$id_stud','$id_prod','$tipo_prod','$testo')");
}

if ($result) {
    $conn->query("COMMIT");
} else {
    $conn->query("ROLLBACK");
}
$conn->query("UNLOCK TABLES");

echo $_GET['testo'];
?>