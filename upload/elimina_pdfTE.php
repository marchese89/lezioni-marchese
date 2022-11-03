<?php session_start();

if (isset($_SESSION['percorsoPDF_TE'])) {
    unlink("../" . $_SESSION['percorsoPDF_TE']);
}
unset($_SESSION['percorsoPDF_TE']);
unset($_SESSION['pdfTECaricato']);


header('Location: ../nuovo-esercizio.html');