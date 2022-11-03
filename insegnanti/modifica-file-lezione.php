<?php 
session_start();

include '../config/mysql-config.php';
$id = $_POST['id'];

$result = $conn->query("SELECT * FROM lezione WHERE id='$id'");
$lezione = $result->fetch_assoc();

if (isset($_SESSION['percorsoPDF_L'])) {
    unlink("../" . $lezione['percorso_file']);
    $percorso_file = $_SESSION['percorsoPDF_L'];
    $conn->query("UPDATE lezione SET percorso_file ='$percorso_file' WHERE id='$id'");
 
    unset($_SESSION['percorsoPDF_L']);
}

header("Location: ../modifica-lezione-". $id .".html");

?>