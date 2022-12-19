<?php 
include_once '../config/mysql-config.php';
include_once '../script/funzioni-php.php';

session_start();

$id = $_POST['id'];
$prezzo = $_POST['prezzo_s'];

$svolgimento = $_SESSION['percorsoPDF_SL'];

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES richieste_lezioni WRITE");
$conn->query("BEGIN");
$r = $conn->query("UPDATE richieste_lezioni SET svolgimento = '$svolgimento', prezzo = '$prezzo' WHERE id = '$id'");
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