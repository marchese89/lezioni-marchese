<?php
session_start();

if(!isset($_SESSION['user'])){
    header('Location: ../index.html');
}


date_default_timezone_set('Europe/Rome');
include_once '../config/mysql-config.php';
include_once '../script/funzioni-php.php';
// Include required PHPMailer files
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';
require '../phpmailer/Exception.php';
// Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$traccia = $_SESSION['percorsoPDF_RL'];
$studente = trovaIdStudente($_SESSION['user'], $conn);
$titolo = $_POST['titolo_l'];

$data = date("Y-m-d H:i:s");
mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES richieste_lezioni WRITE");
$conn->query("BEGIN");
$r = $conn->query("INSERT INTO richieste_lezioni (titolo,studente,traccia,data) VALUES ('$titolo','$studente','$traccia','$data')");
if ($r) {
    $conn->query("COMMIT");
    $conn->query("UNLOCK TABLES");
    unset($_SESSION['percorsoPDF_RL']);
    unset($_SESSION['pdfRLCaricato']);
    //invio email //TODO
    $rr = $conn->query("SELECT * FROM amministratore");
    $admin = $rr->fetch_assoc();
    $to = $admin['email'];
    
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
    $mail->Subject = "Nuova Richiesta Studente";
    // Set sender email
    $mail->setFrom('info@lezioni-marchese.it');
    // Enable HTML
    $mail->isHTML(true);
    // Email body
    $mail->Body = "Gentile insegnante,<br>uno studente ha effettuato una richiesta.<br>Consultare il sito per ulteriori dettagli.<br><br><br>Lezioni Marchese";
    // Add recipient
    $mail->addAddress($to);
    // Finally send email
    $mail->send();
    // Closing smtp connection
    $mail->smtpClose();
    
    header("Location: ../richiesta-lezione-inserita.html");
} else {
    $conn->query("ROLLBACK");
    $conn->query("UNLOCK TABLES");
    header("Location: ../richiesta-lezione-fallita.html");
    
}

?>