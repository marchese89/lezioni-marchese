<?php
session_start();

include '../config/mysql-config.php';

$vecchiaPass = $_POST['vecchiaPass'];
$nuovaPass = password_hash($_POST['nuovaPass'],PASSWORD_DEFAULT);


$email = $_SESSION['user'];

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES utente WRITE");
$conn->query("BEGIN");

$trovaUtente = "SELECT * FROM utente WHERE email='$email'";
$res = $conn->query($trovaUtente);


$utente = $res->fetch_assoc();


if (password_verify($vecchiaPass, $utente['password'])) {

    $aggiornaCliente = "UPDATE utente SET password='$nuovaPass' WHERE email='$email'";
    if (!$conn->query($aggiornaCliente)) {
        $conn->query("ROLLBACK");
        $conn->query("UNLOCK TABLES");
        echo '<tr><th height="100px">&nbsp;</th></tr><tr><th height=80px><font color="red">Errore,<br>Problemi durante l\'inserimento</font></th></tr>';
    }else{
        $conn->query("COMMIT");
        $conn->query("UNLOCK TABLES");
        echo '<tr><th height="100px">&nbsp;</th></tr><tr><th height=80px><font color="green">Password Cambiata</font></th></tr>';
    }
}else{
    $conn->query("ROLLBACK");
    $conn->query("UNLOCK TABLES");
    echo '<tr><th height="100px">&nbsp;</th></tr><tr><th height=80px><font color="red">Errore,<br>vecchia password non corrispondente!</font></th></tr>';
}


