<?php 
session_start();

include '../config/mysql-config.php';
$corso = $_GET['id_corso'];
$id = $_GET['id'];

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES lezione WRITE");
$conn->query("BEGIN");

$result = $conn->query("SELECT * FROM lezione WHERE id='$id'");
$lezione = $result->fetch_assoc();

if (isset($_SESSION['percorsoPDF_L'])) {
    unlink("../" . $lezione['percorso_file']);
    $file_lezione = $_SESSION['percorsoPDF_L'];
    $r = $conn->query("UPDATE lezione SET lezione = '$file_lezione' WHERE id='$id'");
    if ($r) {
        unset($_SESSION['percorsoPDF_L']);
        $conn->query("COMMIT");
    } else {
        $conn->query("ROLLBACK");
    }
}

$conn->query("UNLOCK TABLES");

header("Location: ../modifica-lezione-". $corso . "-" . $id . ".html");

?>