<?php
session_start();
include '../config/mysql-config.php';

mysqli_autocommit($conn, FALSE);

$conn->query("LOCK TABLES utente WRITE, studente WRITE");
$conn->query("BEGIN");

$email = $_SESSION['user'];

$nuovaEmail = $_POST['email'];
$via = str_replace("'", "''", $_POST['via']);
$n_civico = $_POST['n_civico'];
$citta = str_replace("'", "''", $_POST['citta']);
$provincia = $_POST['provincia'];
$cap = $_POST['cap'];

$res = $conn->query("SELECT * FROM utente WHERE email='$email'");
$utente = $res->fetch_assoc();
$id_utente = $utente['id'];

$result2 = $conn->query("SELECT * FROM studente WHERE utente_s = '$id_utente'");
$studente = $result2->fetch_assoc();
$id_studente = $studente['id'];
echo 'ciao';

$aggiornaCliente = "UPDATE utente SET email='$nuovaEmail' WHERE id='$id_utente'";
echo 'aggiorna cliente';
if (! $conn->query($aggiornaCliente)) {
    $conn->query("ROLLBACK");
} else {
    $res2 = $conn->query("UPDATE studente SET via = '$via', n_civico = '$n_civico', citta = '$citta', provincia = '$provincia', cap = '$cap' WHERE id = '$id_studente'");
    if ($res2) {
        echo 'commit';
        $conn->query("COMMIT");
        echo 'commit';
        $_SESSION['user'] = $nuovaEmail;
    } else {
        echo 'rollback';
        $conn->query("ROLLBACK");
    }
}

$conn->query("UNLOCK TABLES");

header("Location: ../modifica-dati2.html");
        
        


