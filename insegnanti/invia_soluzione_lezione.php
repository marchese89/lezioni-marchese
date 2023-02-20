<?php 
include_once '../config/mysql-config.php';
include_once '../script/funzioni-php.php';

// Include required PHPMailer files
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';
require '../phpmailer/Exception.php';
// Define name spaces
use PHPMailer\PHPMailer\PHPMailer;

session_start();

$id = $_POST['id'];
$prezzo = $_POST['prezzo_s'];

$svolgimento = $_SESSION['percorsoPDF_SL'];

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES richieste_lezioni WRITE, utente READ, studente READ");
$conn->query("BEGIN");
$r = $conn->query("UPDATE richieste_lezioni SET svolgimento = '$svolgimento', prezzo = '$prezzo', evasa = '1' WHERE id = '$id'");
if ($r) {
    unset($_SESSION['percorsoPDF_SL']);
    unset($_SESSION['pdfSLCaricato']);
    $rr = $conn->query("SELECT * FROM richieste_lezioni WHERE id = '$id'");
    $richiesta = $rr->fetch_assoc();
    $id_stud = $richiesta['studente'];
    $rr2 = $conn->query("SELECT * FROM studente WHERE id = '$id_stud'");
    $studente = $rr2->fetch_assoc();
    $id_ut = $studente['utente_s'];
    $rr3 = $conn->query("SELECT * FROM utente WHERE id = '$id_ut'");
    $utente = $rr3->fetch_assoc();
    $to = $utente['email'];
    $conn->query("COMMIT");
    
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
    $mail->Subject = "Richiesta Evasa";
    // Set sender email
    $mail->setFrom('info@lezioni-marchese.it');
    // Enable HTML
    $mail->isHTML(true);
    // Email body
    $mail->Body = "Gentile studente,<br>la sua richiesta &egrave; stata evasa.<br>Consultare il sito per ulteriori dettagli.<br><br><br>Lezioni Marchese";
    // Add recipient
    $mail->addAddress($to);
    // Finally send email
    $mail->send();
    // Closing smtp connection
    $mail->smtpClose();
    
    
} else {
    $conn->query("ROLLBACK");
}
$conn->query("UNLOCK TABLES");


header("Location: ../visualizza-richiesta-lezione-i-". $id .".html");

?>