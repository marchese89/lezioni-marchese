<?php 
include_once '../config/mysql-config.php';
include_once '../script/funzioni-php.php';

session_start();

$id = $_POST['id'];

$svolgimento = $_SESSION['percorsoPDF_SL'];

//troviamo l'id della soluzione precedente
$result = $conn->query("SELECT * FROM richieste_lezioni WHERE id = '$id'");
$richiesta = $result->fetch_assoc();

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES corso WRITE");
$conn->query("BEGIN");

unlink("../" . $richiesta['svolgimento']);

$r = $conn->query("UPDATE richieste_lezioni SET svolgimento = '$svolgimento' WHERE id = '$id'");

if ($r) {
    unset($_SESSION['percorsoPDF_SL']);
    unset($_SESSION['pdfSLCaricato']);
    $conn->query("COMMIT");
} else {
    $conn->query("ROLLBACK");
}
$conn->query("UNLOCK TABLES");


header("Location: ../visualizza-richiesta-lezione-i-". $id .".html");

?>