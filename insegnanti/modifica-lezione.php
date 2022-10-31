<?php
session_start();

include '../config/mysql-config.php';

$id = $_POST['id'];
$titolo = $_POST['titolo_lezione'];
$numero = $_POST['numero_lezione'];
$prezzo_lezione = $_POST['prezzo_lezione'];

$result = $conn->query("SELECT * FROM lezione WHERE id='$id'");
$argomento = $result->fetch_assoc();

if (isset($_SESSION['percorsoPDF_L'])) {
    unlink("../" . $argomento['percorso_file']);
    $percorso_file = $_SESSION['percorsoPDF_L'];
    $conn->query("UPDATE lezione SET titolo='$titolo', numero='$numero' , percorso_file ='$percorso_file', prezzo ='$prezzo_lezione'  WHERE id='$id'");
    
    unset($_SESSION['percorsoPDF_L']);
}else{
    $conn->query("UPDATE lezione SET titolo='$titolo', numero='$numero', prezzo ='$prezzo_lezione'  WHERE id='$id'");
}



header("Location: ../modifica-lezione-". $id .".html");
?>