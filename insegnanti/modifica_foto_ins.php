<?php
include '../config/mysql-config.php';
include_once '../script/funzioni-php.php';
session_start();
$percorsoFoto = $_SESSION['percorsoFoto'];
$email = $_SESSION['user'];
mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES amministratore WRITE");
$conn->query("BEGIN");
$res = $conn->query("UPDATE amministratore SET foto = '$percorsoFoto' WHERE email = '$email'");
if($res){
    $conn->query("COMMIT");
    unset($_SESSION['percorsoFoto']);
    unset($_SESSION['to_delete']);
    unset($_SESSION['FotoCaricata']);
}else{
    $conn->query("ROLLBACK");
}

$conn->query("UNLOCK TABLES");

header('Location: ../modifica-dati-insegnante.html');
?>