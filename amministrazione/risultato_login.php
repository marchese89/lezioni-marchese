<?php
include '../config/mysql-config.php';
session_start();
date_default_timezone_set('Europe/Rome');
$email = $_POST['email'];
$pass = $_POST['password'];
if (isset($_GET['return'])) {
    $return = $_GET['return'];
}
$sql = "SELECT * FROM amministratore WHERE email='$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $email;
    while ($row = $result->fetch_assoc()) {
        $email = $row['email'];
        if (password_verify($pass, $row['password'])) {
            $_SESSION['user'] = "admin";
            $_SESSION['nomeUtente'] = "amministratore";
            $_SESSION['loginCorretto'] = TRUE;
            $_SESSION['last_login'] = $row['ultimo_accesso'];
        } else {
            $_SESSION['loginCorretto'] = FALSE;
        }
    }
    if ($_SESSION['loginCorretto']) {
        $data = date("Y-m-d H:i:s");
        $conn->query("UPDATE amministratore SET ultimo_accesso='$data' WHERE email='$email'");
    }
} else {

    $sql2 = "SELECT * FROM utente WHERE email='$email'";
    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            if (password_verify($pass, $row['password'])) {
                $_SESSION['user'] = $row['email'];
                $_SESSION['nomeUtente'] = $row['nome'];
                $_SESSION['loginCorretto'] = TRUE;
                $_SESSION['last_login'] = $row['ultimo_accesso'];
                break;
            } else {
                $_SESSION['loginCorretto'] = FALSE;
            }
        }
        if ($_SESSION['loginCorretto']) {
            $data = date("Y-m-d H:i:s");
            $conn->query("UPDATE utente SET ultimo_accesso='$data' WHERE email='$email'");
        }
    } else {
        $_SESSION['loginCorretto'] = FALSE;
    }
}
$redirezione = '';
if ($_SESSION['loginCorretto']) {
    if ($_SESSION['user'] === "admin") {
        $redirezione = 'Location: ../home-admin.html';
    } else {
        $redirezione = 'Location: ../home-user.html';
    }
}else{
    $redirezione = 'Location: ../login.html';
}


header($redirezione);
