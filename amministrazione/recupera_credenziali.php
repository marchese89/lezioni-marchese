<?php
include '../config/mysql-config.php';

// Include required PHPMailer files
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';
require '../phpmailer/Exception.php';
// Define name spaces
use PHPMailer\PHPMailer\PHPMailer;

session_start();
$email = $_POST['email'];

function generaPass($length = 10)
{
    $salt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#!?.,;:';
    $len = strlen($salt);
    $pass = '';
    mt_srand(10000000 * (double) microtime());
    for ($i = 0; $i < $length; $i ++) {
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
        $mail->Username = "info@lezioni-marchese.it";
        // Set gmail password
        $mail->Password = "3DWjnkVW#tkez5NS";
        // Email subject
        $mail->Subject = "Recupero Credenziali";
        // Set sender email
        $mail->setFrom('info@lezioni-marchese.it');
        // Enable HTML
        $mail->isHTML(true);
        // Email body
        $mail->Body = "Gentile " . $utente['nome'] . " " . $utente['cognome'] . ",<br>la sua nuova password &egrave;:<br><b> " . $nuovaPass . "</b>.<br><br>la preghiamo di modificarla al tuo prossimo accesso.<br>Cordialmente,<br><br>Lezioni Marchese";
        // Add recipient
        $mail->addAddress($email);
        // Finally send email
        $mail->send();
        // Closing smtp connection
        $mail->smtpClose();

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
            $mail->Username = "info@lezioni-marchese.it";
            // Set gmail password
            $mail->Password = "3DWjnkVW#tkez5NS";
            // Email subject
            $mail->Subject = "Recupero Credenziali";
            // Set sender email
            $mail->setFrom('info@lezioni-marchese.it');
            // Enable HTML
            $mail->isHTML(true);
            // Email body
            $mail->Body = "Ciao amministratore,<br>la tua nuova password &egrave;:<br><b>" . $nuovaPass . "</b>";
            // Add recipient
            $mail->addAddress($emailAdmin);
            // Finally send email
            $mail->send();
            // Closing smtp connection
            $mail->smtpClose();

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

