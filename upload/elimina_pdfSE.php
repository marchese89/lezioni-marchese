<?php session_start();

if (isset($_SESSION['percorsoPDF_SE'])) {
    unlink("../" . $_SESSION['percorsoPDF_SE']);
}
unset($_SESSION['percorsoPDF_SE']);
unset($_SESSION['pdfSECaricato']);


header('Location: ../nuovo-esercizio.html');