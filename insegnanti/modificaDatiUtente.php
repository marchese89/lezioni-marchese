<?php
session_start();
include '../config/mysql-config.php';

mysqli_autocommit($conn, FALSE);

$conn->query("LOCK TABLES utente WRITE");
$conn->query("BEGIN");

$email = $_SESSION['user'];

$nuovaEmail = $_POST['email'];
$via = str_replace("'", "''", $_POST['via']);
$n_civico = $_POST['n_civico'];
$citta = str_replace("'", "''", $_POST['citta']);
$provincia = $_POST['provincia'];
$cap = $_POST['cap'];
$piva = $_POST['piva'];
$str_sk = $_POST['str_sk'];

$aggiorna = "UPDATE amministratore SET via = '$via', n_civico = '$n_civico', citta = '$citta', provincia = '$provincia', cap = '$cap', 
piva = '$piva', stripe_private_key = '$str_sk',  email='$nuovaEmail' WHERE email ='$email'";
if (! $conn->query($aggiorna)) {
    $conn->query("ROLLBACK");
} else {
    $_SESSION['user'] = $nuovaEmail;
    $conn->query("COMMIT");
}

$conn->query("UNLOCK TABLES");

header("Location: ../modifica-dati-insegnante.html");
        
        


