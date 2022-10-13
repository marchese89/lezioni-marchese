<?php
session_start();

include '../config/mysql-config.php';

$vecchiaPass = $_POST['vecchiaPass'];
$nuovaPass = password_hash($_POST['nuovaPass'],PASSWORD_DEFAULT);


$email = $_SESSION['user'];

$trovaUtente = "SELECT * FROM utente WHERE email='$email'";
$res = $conn->query($trovaUtente);


$utente = $res->fetch_assoc();


if (password_verify($vecchiaPass, $utente['password'])) {

    $aggiornaCliente = "UPDATE utente SET password='$nuovaPass' WHERE email='$email'";
    if (!$conn->query($aggiornaCliente)) {
        echo '<tr><th height="100px">&nbsp;</th></tr><tr><th height=80px><font color="red">Errore,<br>Problemi durante l\'inserimento</th></tr><tr><th><a href="modifica-pass.html">indietro</a></th></tr>';
    }else{
        echo '<tr><th height="100px">&nbsp;</th></tr><tr><th height=80px>Password Cambiata</th></tr><tr><th><a href="home-user.html">indietro</a></th></tr>';
    }
}else{
    echo '<tr><th height="100px">&nbsp;</th></tr><tr><th height=80px><font color="red">Errore,<br>vecchia password non corrispondente!</font></th></tr><tr><th><a href="modifica-pass.html">indietro</a></th></tr>';
}


