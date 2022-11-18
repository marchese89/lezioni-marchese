<?php 
session_start();

include '../config/mysql-config.php';
$id = $_GET['id'];

$result = $conn->query("SELECT * FROM lezione WHERE id='$id'");
$lezione = $result->fetch_assoc();

if (isset($_SESSION['percorsoPDF_PL'])) {
    unlink("../" . $lezione['presentazione']);
    $percorso_file = $_SESSION['percorsoPDF_PL'];
    $conn->query("UPDATE lezione SET presentazione = '$percorso_file' WHERE id='$id'");
 
    unset($_SESSION['percorsoPDF_PL']);
}

header("Location: ../modifica-lezione-". $id .".html");

?>