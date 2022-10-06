<?php
session_start();
include '../config/mysql-config.php';

mysqli_autocommit($conn, FALSE);

$conn->query("LOCK TABLES utente WRITE");
$conn->query("BEGIN");
$committaTutto = TRUE;

$email = $_SESSION['user'];
$nome = str_replace("'", "''", $_POST['nomeC']);
$cognome = str_replace("'", "''", $_POST['cognomeC']);
$nuovaEmail = $_POST['emailC'];

$viaModificata = FALSE;

$trovaCliente = "SELECT * FROM utente WHERE email='$email'";
$res = $conn->query($trovaCliente);
$cliente = $res->fetch_assoc();

if (! empty($nome) && $nome !== $cliente['nome']) {
    $aggiornaCliente = "UPDATE utente SET nome='$nome' WHERE email='$email'";
    if (! $conn->query($aggiornaCliente)) {
        $conn->query("ROLLBACK");
        $committaTutto = FALSE;
    }
    $_SESSION['nomeUtente'] = $nome;
}

if (! empty($cognome) && $cognome !== $cliente['cognome']) {
    $aggiornaCliente = "UPDATE utente SET cognome='$cognome' WHERE cf='$email'";
    if (! $conn->query($aggiornaCliente)) {
        $conn->query("ROLLBACK");
        $committaTutto = FALSE;
    }
}

if (! empty($nuovaEmail) && $nuovaEmail !== $cliente['email']) {
    $aggiornaCliente = "UPDATE cliente SET email='$nuovaEmail' WHERE cf='$email'";
    if (! $conn->query($aggiornaCliente)) {
        $conn->query("ROLLBACK");
        $committaTutto = FALSE;
    }
}

if ($committaTutto) {
    $conn->query("COMMIT");
} else {
    $conn->query("ROLLBACK");
}

$conn->query("UNLOCK TABLES");

header("Location: ../modifica-dati.html");
        
        


