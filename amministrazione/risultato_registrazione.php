<?php

date_default_timezone_set('Europe/Rome');

include '../config/mysql-config.php';
// Include required PHPMailer files

include '../phpmailer/SMTP.php';
include '../phpmailer/Exception.php';
include '../phpmailer/PHPMailer.php';

// Define name spaces
use PHPMailer\PHPMailer\PHPMailer;

function inviaEmail($mittente,$destinatario, $password, $oggetto, $contenuto)
{
    // invio email
    // Create instance of PHPMailer
    $mail = new PHPMailer();
    // Set mailer to use smtp
    $mail->isSMTP();
    // Define smtp host
    $mail->Host = "smtps.aruba.it";
    // Enable smtp authentication
    $mail->SMTPAuth = true;
    // Set smtp encryption type (ssl/tls)
    $mail->SMTPSecure = "ssl";
    // Port to connect smtp
    $mail->Port = "465";
    // Set gmail username
    $mail->Username = $mittente;
    // Set gmail password
    $mail->Password = $password;//"3DWjnkVW.tkez5NS";
    // Email subject
    $mail->Subject = $oggetto;//"Recupero Credenziali";
    // Set sender email
    $mail->setFrom($mittente);
    // Enable HTML
    $mail->isHTML(true);
    // Email body
    $mail->Body = $contenuto;
    //"Gentile " . $utente['nome'] . " " . $utente['cognome'] . ",<br>la sua nuova password &egrave;:<br><b> " . $nuovaPass . "</b>.<br><br>la preghiamo di modificarla al tuo prossimo accesso.<br>Cordialmente,<br><br>Lezioni Marchese";
    // Add recipient
    $mail->addAddress($destinatario);
    // Finally send email
    $mail->send();
    // Closing smtp connection
    $mail->smtpClose();
}

session_start();

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES utente WRITE,studente WRITE");
$conn->query("BEGIN");

function generaCodice($length = 6)
{
    $salt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ012345678';
    $len = strlen($salt);
    $codiceAtt = '';
    mt_srand(10000000 * (float) microtime());
    for ($i = 0; $i < $length; $i++) {
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

$result = -1;
$result = $conn->query("INSERT INTO utente (email,password,nome,cognome,codice_attivaz,data_iscrizione,stato_account) VALUES('$email1','$password1','$nome','$cognome','$codiceA','$data','0')");

$testoMailReg = "Gentile cliente,<br>grazie per essersi registrato.<br>Per attivare il suo account inserisca il codice:<br><br> " . $codiceA . "<br>dopo aver effettuato l'accesso<br><br>Lezioni Informatica";

if ($result) {
    $r = $conn->query("SELECT * FROM utente WHERE email='$email1'");
    $ut = $r->fetch_assoc();
    $id = $ut['id'];
    $r2 = $conn->query("INSERT INTO studente(utente_s,via,n_civico,citta,provincia,cap,cf) VALUES('$id','$via','$n_civico','$citta','$provincia','$cap','$cf')");
    if ($r2) {
        $conn->query("COMMIT");

        $_SESSION['registrazione'] = "ok";

        $mittente = "register@lezioni-informatica.it";
        $destinatario = $email1;
        $oggetto = "Completa la tua registrazione";
        $contenuto = $testoMailReg;
        $password = "3DWjnkVW.tkez5NS";
        inviaEmail($mittente, $destinatario, $password, $oggetto, $contenuto);
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
