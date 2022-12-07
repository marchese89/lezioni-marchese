
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

$nome = str_replace("'", "''", $_POST['nome']);
$cognome = str_replace("'", "''", $_POST['cognome']);
$via = str_replace("'", "''", $_POST['via']);
$n_civico = $_POST['n_civico'];
$citta = str_replace("'", "''", $_POST['citta']);
$provincia = $_POST['provincia'];
$cap = $_POST['cap'];
$cf = strtoupper($_POST['cf']);
$email1 = $_POST['email1'];
$password1 = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
$codiceA = generaCodice();
$data = date("Y-m-d H:i:s");

$result = - 1;
$result = $conn->query("INSERT INTO utente (email,password,nome,cognome,codice_attivaz,data_iscrizione,stato_account) VALUES('$email1','$password1','$nome','$cognome','$codiceA','$data','0')");

$testoMailReg = "Gentile cliente\ngrazie per essersi registrato.\nPer attivare il suo account inserisca" . " il codice " . $codiceA . " dopo aver effettuato l'accesso\nEasy Learning";
if ($result) {
    $r = $conn->query("SELECT * FROM utente WHERE email='$email1'");
    $ut = $r->fetch_assoc();
    $id = $ut['id'];
    $r2 = $conn->query("INSERT INTO studente(utente_s,via,n_civico,citta,provincia,cap,cf) VALUES('$id','$via','$n_civico','$citta','$provincia','$cap','$cf')");
    if ($r2) {
        $conn->query("COMMIT");

        $_SESSION['registrazione'] = "ok";

        $to = $email1;
        $subject = "Completa la tua registrazione";
        $sender = "register@easylearning.com"; // TODO da modificare

        $headers = "Reply-To: EasyLearning <$sender>\r\n";
        $headers .= "Return-Path: EasyLearning <$sender>\r\n";
        $headers .= "From: EasyLearning <$sender>\r\n";
        $headers .= "Organization: EasyLearning\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/plain; charset=\"iso-8859-1\"\r\n";
        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP " . phpversion() . "\r\n";

        mail($to, $subject, $testoMailReg, $headers, "-f$sender");
    } else {
        $risultatoReg = "no";
        $conn->query("ROLLBACK");
    }
} else {
    $risultatoReg = "no";
    $conn->query("ROLLBACK");
}

$conn->query("UNLOCK TABLES");

header("Location: ../risultato-operazione.html");

        


   
