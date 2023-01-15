<?php
session_start();
date_default_timezone_set('Europe/Rome');
include_once '../config/mysql-config.php';
include_once '../script/funzioni-php.php';
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
    
    $to = "marchese89@hotmail.com";
    $subject = "Nuova Richiesta Studente";
    $sender = "info@easylearning.com"; // TODO da modificare
    $testoMailReg = "Gentile insegnante,\nuno studente ha effettuato una richiesta.\nConsultare il sito per ulteriori dettagli.\nEasy Learning";
    
    $headers = "Reply-To: EasyLearning <$sender>\r\n";
    $headers .= "Return-Path: EasyLearning <$sender>\r\n";
    $headers .= "From: EasyLearning <$sender>\r\n";
    $headers .= "Organization: EasyLearning\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=\"iso-8859-1\"\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP " . phpversion() . "\r\n";
    
    mail($to, $subject, $testoMailReg, $headers, "-f$sender");
    
    header("Location: ../richiesta-lezione-inserita.html");
} else {
    $conn->query("ROLLBACK");
    $conn->query("UNLOCK TABLES");
    header("Location: ../richiesta-lezione-fallita.html");
    
}

?>