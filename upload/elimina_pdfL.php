<?php session_start();

if (isset($_SESSION['percorsoPDF_L'])) {
    unlink("../" . $_SESSION['percorsoPDF_L']);
}
unset($_SESSION['percorsoPDF_L']);
unset($_SESSION['pdfLCaricato']);
header('Location: ../nuova-lezione.html');