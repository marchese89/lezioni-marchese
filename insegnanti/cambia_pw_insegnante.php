<?php
session_start();

include '../config/mysql-config.php';

$vecchiaPass = $_POST['vecchiaPass'];
$nuovaPass = password_hash($_POST['nuovaPass'],PASSWORD_DEFAULT);


$email = $_SESSION['user'];

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES utente WRITE");
$conn->query("BEGIN");


$res = $conn->query("SELECT * FROM amministratore WHERE email='$email'");

$utente = $res->fetch_assoc();

if (password_verify($vecchiaPass, $utente['password'])) {

    $aggiornaCliente = "UPDATE amministratore SET password='$nuovaPass' WHERE email='$email'";
    if (!$conn->query($aggiornaCliente)) {
        $conn->query("ROLLBACK");
        $conn->query("UNLOCK TABLES");
        $_SESSION['res_cambia_pw_admin'] = '<tr><td><font color="red">Errore,<br>Problemi durante l\'inserimento</font></td></tr>';
    }else{
        $conn->query("COMMIT");
        $conn->query("UNLOCK TABLES");
        $_SESSION['res_cambia_pw_admin'] = '<tr><td><font color="green">Password Cambiata</font></td></tr>';
    }
}else{
    $conn->query("ROLLBACK");
    $conn->query("UNLOCK TABLES");
    $_SESSION['res_cambia_pw_admin'] = '<tr><td><font color="red">Errore,<br>vecchia password non corrispondente!</font></td></tr>';
}

header("Location: ../modifica-pass-insegnante.html");
