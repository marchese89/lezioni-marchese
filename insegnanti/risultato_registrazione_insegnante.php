<?php
session_start();
date_default_timezone_set('Europe/Rome');
include '../config/mysql-config.php';
include '../script/validazione_campi/validazioneServer.php';

// manteniamo nella sessione i campi di registrazione già inseriti
$_SESSION['nome'] = $_POST['nome'];
$_SESSION['cognome'] = $_POST['cognome'];
$_SESSION['cf'] = $_POST['cf'];
$_SESSION['email1'] = $_POST['email1'];
$_SESSION['email2'] = $_POST['email2'];
$_SESSION['pass1'] = $_POST['pass1'];
$_SESSION['pass2'] = $_POST['pass2'];

unset($_SESSION['file_non_caricati']);
if (! isset($_SESSION['percorsoFoto']) | ! isset($_SESSION['percorsoFotoDI']) | ! isset($_SESSION['percorsoFotoCF']) | ! isset($_SESSION['percorsoPDF_TS']) | ! isset($_SESSION['percorsoPDF_CV'])) {
    $_SESSION['file_non_caricati'] = 'X';
    header('Location: ../lavora-con-noi.html');
}

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
$cf = $_POST['cf'];
$percorsoFoto = $_SESSION['percorsoFoto'];
$percorsoFotoDI = $_SESSION['percorsoFotoDI'];
$percorsoFotoCF = $_SESSION['percorsoFotoCF'];
$percorsoPdfTS = $_SESSION['percorsoPDF_TS'];
$percorsoPdfCV = $_SESSION['percorsoPDF_CV'];

$email1 = $_POST['email1'];

$password1 = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
$codiceA = generaCodice();
$data = date("Y-m-d H:i:s");

$sql0 = "INSERT INTO utente (email,password,nome,cognome,codice_attivaz,data_iscrizione,stato_account)" . "VALUES('$email1','$password1','$nome','$cognome','$codiceA','$data','0')";
$result = - 1;

$result1 = $conn->query($sql0);
if ($result1) {
    $result2 = $conn->query("SELECT * FROM utente WHERE email='" . $email1 . "'");
    $utente = $result2->fetch_assoc();
    $id = $utente['id']; // id utente da inserire nella tabella insegnante
    echo 'id: ' . $id;
    $result = $conn->query("INSERT INTO insegnante(cf,foto,doc_id,codice_fiscale,titolo_di_studio,cv,utente_i) VALUES('$cf','$percorsoFoto','$percorsoFotoDI','$percorsoFotoCF','$percorsoPdfTS','$percorsoPdfCV','$id')");
}

$testoMailReg = "Gentile cliente\ngrazie per essersi registrato.\nPer attivare il suo account inserisca" . " il codice " . $codiceA . " dopo aver effettuato l'accesso\nEasy Learning";
if ($result) {
    $conn->query("COMMIT");
    
    session_destroy();
    session_start();

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

$conn->query("UNLOCK TABLES");

header("Location: ../risultato-operazione.html");
?>