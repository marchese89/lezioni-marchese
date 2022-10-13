
<?php
date_default_timezone_set('Europe/Rome');
include '../config/mysql-config.php';
include '../script/validazione_campi/validazioneServer.php';
session_start();

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES utente WRITE,studente WRITE");
$conn->query("BEGIN");

function generaCodice($length = 6)
{
    $salt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ012345678';
    $len = strlen($salt);
    $codiceAtt = '';
    mt_srand(10000000 * (double) microtime());
    for ($i = 0; $i < $length; $i ++) {
        $codiceAtt .= $salt[mt_rand(0, $len - 1)];
    }
    return $codiceAtt;
}
$datiValidi = TRUE;
$nome = str_replace("'", "''", $_POST['nome']);
$cognome = str_replace("'", "''", $_POST['cognome']);

$email1 = $_POST['email1'];
$email2 = $_POST['email2'];
$password1 = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
$codiceA = generaCodice();
$data = date("Y-m-d H:i:s");

$sql0 = "INSERT INTO utente (email,password,nome,cognome,codice_attivaz,data_iscrizione,stato_account)" . "VALUES('$email1','$password1','$nome','$cognome','$codiceA','$data','0')";
$result = - 1;
if ($datiValidi) {
    $result = $conn->query($sql0);
}
$testoMailReg = "Gentile cliente\ngrazie per essersi registrato.\nPer attivare il suo account inserisca" . " il codice " . $codiceA . " dopo aver effettuato l'accesso\nEasy Learning";
if ($result) {
    $risultatoReg = "ok";
    $conn->query("COMMIT");

    $_SESSION['registrazione'] = $risultatoReg;
    
    $to = $email1;
    $subject = "Completa la tua registrazione";
    $sender = "register@volantinimanifesti.it"; // TODO da modificare

    $headers = "Reply-To: VolantinieManifesti <$sender>\r\n";
    $headers .= "Return-Path: VolantinieManifesti <$sender>\r\n";
    $headers .= "From: VolantinieManifesti <$sender>\r\n";
    $headers .= "Organization: VolantinieManifesti\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=\"iso-8859-1\"\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP " . phpversion() . "\r\n";

    mail($to, $subject, $testoMailReg, $headers, "-f$sender");
    echo 'email inviata';
} else {
    $risultatoReg = "no";
    $conn->query("ROLLBACK");
}

$conn->query("UNLOCK TABLES");


header("Location: ../risultato-operazione.html");

        


   
