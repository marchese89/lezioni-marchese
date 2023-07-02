<?php
include '../config/mysql-config.php';
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
$email = $_POST['email'];

function generaPass($length = 10)
{
    $salt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#!?.,;:';
    $len = strlen($salt);
    $pass = '';
    mt_srand(10000000 * (float) microtime());
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

        // invio email
        $mittente = "info@lezioni-informatica.it";
        $destinatario = $email;
        $password = "3DWjnkVW.tkez5NS";
        $oggetto = "Recupero Credenziali";
        $contenuto = "Gentile " . $utente['nome'] . " " . $utente['cognome'] . ",<br>la sua nuova password &egrave;:<br><b> " . $nuovaPass . "</b>.<br><br>la preghiamo di modificarla al tuo prossimo accesso.<br>Cordialmente,<br><br>Lezioni Marchese";
        inviaEmail($mittente, $destinatario, $password, $oggetto, $contenuto);

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

            // invio email
            $mittente = "info@lezioni-informatica.it";
            $destinatario = $email;
            $password = "3DWjnkVW.tkez5NS";
            $oggetto = "Recupero Credenziali";
            $contenuto = "Ciao amministratore,<br>la tua nuova password &egrave;:<br><b>" . $nuovaPass . "</b>";
            inviaEmail($mittente, $destinatario, $password, $oggetto, $contenuto);

            $_SESSION['recupero_credenziali'] = "ok";
        } else {
            $_SESSION['recupero_credenziali'] = "noquery";
        }
    } else {
        $_SESSION['recupero_credenziali'] = "noemail";
    }
}
$conn->query("UNLOCK TABLES");
header("Location: ../index.php?pagina=info_res_operazioni.php");
