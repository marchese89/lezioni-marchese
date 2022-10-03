<?php
include '../config/mysql-config.php';

$user = $_POST['email'];
$pass = $_POST['password'];
$return;
if (! empty($_GET['return'])) {
    $return = $_GET['return'];
}
$sql = "SELECT * FROM amministratore WHERE email='$user'";
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

    $sql2 = "SELECT * FROM utente WHERE email='$user'";
    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {
        $email;
        while ($row = $result2->fetch_assoc()) {
            if (password_verify($pass, $row['password'])) {
                $email = $row['email'];
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
            $conn->query("UPDATE cliente SET ultimo_accesso='$data' WHERE cf='$email'");
        }
    } else {
        $_SESSION['loginCorretto'] = FALSE;
    }
}
$redirezione = '';
if ($_SESSION['loginCorretto']) {
    if ($_SESSION['user'] === "admin") {
        $redirezione = 'Location: ../index.php?pagina=amministrazione/admin.php';
    } else {
        if (! empty($return)) {
            $cf = $_SESSION['user'];
            $trovaIndirizzi = "SELECT * FROM indirizzo WHERE cliente='$cf'";
            $res = $conn->query($trovaIndirizzi);
            $giaPresente = FALSE;
            while ($indirizzo = $res->fetch_assoc()) {
                if ($indirizzo['via'] == $_SESSION['indirizzo']->getVia()) {
                    $giaPresente = TRUE;
                    $_SESSION['indirizzo_scelto'] = $indirizzo['id_indirizzo'];
                    break;
                }
            }
            if (! $giaPresente) {
                $cf = $_SESSION['user'];
                $via = $_SESSION['indirizzo']->getVia();
                $numC = $_SESSION['indirizzo']->getNumC();
                $cap = $_SESSION['indirizzo']->getCap();
                $comune = $_SESSION['indirizzo']->getComune();
                $provincia = $_SESSION['indirizzo']->getProvincia();

                $inserisciIndirizzo = "INSERT INTO indirizzo(cliente,via,numero_c,cap,comune,provincia)" . " VALUES('$cf','$via','$numC','$cap','$comune','$provincia')";
                $conn->query($inserisciIndirizzo);

                $trovaIndirizzo = "SELECT * FROM indirizzo WHERE cliente='$cf' AND via='$via'";
                $res = $conn->query($trovaIndirizzo);
                $ind = $res->fetch_assoc();
                $_SESSION['indirizzo_scelto'] = $ind['id_indirizzo'];
            }
            $redirezione = 'Location: ../index.php?pagina=acquisti/vai_alla_cassa.php';
        } else {
            $redirezione = 'Location: ../index.html';
        }
    }
    unset($_SESSION['loginCorretto']);
} else {
    if (! empty($return)) {
        $redirezione = 'Location: ../index.php?pagina=clienti/accedi_registrati.php';
    } else {
        $redirezione = 'Location: ../login.html';
    }
}

header($redirezione);
