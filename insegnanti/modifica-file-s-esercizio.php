<?php 
session_start();

include '../config/mysql-config.php';
$corso = $_GET['id_corso'];
$id = $_GET['id'];

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES esercizio WRITE");
$conn->query("BEGIN");
$result = $conn->query("SELECT * FROM esercizio WHERE id='$id'");
$esercizio = $result->fetch_assoc();

if (isset($_SESSION['percorsoPDF_SE'])) {
    unlink("../" . $esercizio['svolgimento']);
    $percorso_file = $_SESSION['percorsoPDF_SE'];
    $r = $conn->query("UPDATE esercizio SET svolgimento = '$percorso_file' WHERE id='$id'");
    if ($r) {
        unset($_SESSION['percorsoPDF_SE']);
        $conn->query("COMMIT");
    } else {
        $conn->query("ROLLBACK");
    }
    
}

$conn->query("UNLOCK TABLES");

header("Location: ../modifica-esercizio-ins-" . $corso . "-" . $id .".html");

?>