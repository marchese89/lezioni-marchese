<?php
session_start();
include '../config/mysql-config.php';

mysqli_autocommit($conn, FALSE);

$conn->query("LOCK TABLES utente WRITE");
$conn->query("BEGIN");


$email = $_SESSION['user'];

$nuovaEmail = $_POST['email'];


$trovaCliente = "SELECT * FROM utente WHERE email='$email'";
$res = $conn->query($trovaCliente);
$utente = $res->fetch_assoc();
$id_utente = $utente['id'];

if (! empty($nuovaEmail) && $nuovaEmail !== $utente['email']) {
    $aggiornaCliente = "UPDATE utente SET email='$nuovaEmail' WHERE id='$id_utente'";
    if (! $conn->query($aggiornaCliente)) {
        $conn->query("ROLLBACK");
    }else{
        $_SESSION['user'] = $nuovaEmail;
        $conn->query("COMMIT");
    }
}


$conn->query("UNLOCK TABLES");

header("Location: ../modifica-dati2-ins.html");
        
        


