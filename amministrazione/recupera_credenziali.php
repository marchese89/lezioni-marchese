<?php

include '../config/mysql-config.php';

session_start();
$email = $_POST['email'];

function generaPass($length = 8) {
    $salt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $len = strlen($salt);
    $pass = '';
    mt_srand(10000000 * (double) microtime());
    for ($i = 0; $i < $length; $i++) {
        $pass .= $salt[mt_rand(0, $len - 1)];
    }
    return $pass;
}

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES utente WRITE,amministratore WRITE");
$conn->query("BEGIN");

$sql = "SELECT * FROM utente WHERE email='$email'";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $utente = $res->fetch_assoc();
    $nuovaPass = generaPass();
    $passCriptata = password_hash($nuovaPass, PASSWORD_DEFAULT);
    $sql2 = "UPDATE utente SET password='$passCriptata' WHERE email='$email'";
    if ($conn->query($sql2)) {
        $conn->query("COMMIT");
        $testoEmail = "Gentile ". $utente['nome'] . " ". $utente['cognome']. ",<br>la sua nuova password &egrave;: " .
                $nuovaPass . ".<br><br>la preghiamo di modificarla al tuo prossimo accesso.<br>Cordialmente,<br><br>VolantiniManifesti";
        
        $to = $email;
        $subject = "Recupero Password";
        $sender = "recupera-credenziali@volantinimanifesti.it";
        $headers = "Reply-To: VolantiniManifesti <$sender>\r\n"; 
        $headers .= "From: VolantiniManifesti <$sender>\r\n";
        $headers .= "Organization: VolantiniManifesti\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\r\n";
        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP " . phpversion(). "\r\n";
            
        mail($to, $subject, $testoEmail, $headers,"-f$sender");
        
        
        $_SESSION['recupero_credenziali'] = "ok";
    } else {
        $_SESSION['recupero_credenziali'] = "noquery";
    }
} else {
    $sql3 = "SELECT * FROM amministratore";
    $res3 = $conn->query($sql3);
    $admin = $res3->fetch_assoc();
    $emailAdmin = $admin['email'];
    if ($email == $emailAdmin) {
        $nuovaPass = generaPass();
        $passCriptata = password_hash($nuovaPass, PASSWORD_DEFAULT);
        if ($conn->query("UPDATE amministratore SET password='$passCriptata' WHERE email='$emailAdmin'")) {
        $conn->query("COMMIT");
        $to = $emailAdmin;
        $subject = "Recupero Password";
        $sender = "recupera-credenziali@volantinimanifesti.it";
        $headers = "Reply-To: VolantiniManifesti <$sender>\r\n"; 
        $headers .= "From: VolantiniManifesti <$sender>\r\n";
        $headers .= "Organization: VolantiniManifesti\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\r\n";
        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP " . phpversion(). "\r\n";
            
        mail($to, $subject, "Ciao amministratore,<br>la tua nuova password &egrave; $nuovaPass", $headers, "-f$sender");            
            
            $_SESSION['recupero_credenziali'] = "ok";
        }else{
            $_SESSION['recupero_credenziali'] = "noquery";
        }
    } else {
        $_SESSION['recupero_credenziali'] = "noemail";
    }
}
$conn->query("UNLOCK TABLES");
header("Location: ../index.php?pagina=info_res_operazioni.php");

