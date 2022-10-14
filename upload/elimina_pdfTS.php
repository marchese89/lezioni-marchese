<?php session_start();

if (isset($_SESSION['percorsoPDF_TS'])) {
    unlink("../" . $_SESSION['percorsoPDF_TS']);
}
unset($_SESSION['percorsoPDF_TS']);
unset($_SESSION['pdf_to_deleteTS']);
unset($_SESSION['pdfTSCaricato']);
header('Location: ../lavora-con-noi.html');

