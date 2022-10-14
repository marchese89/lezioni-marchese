<?php session_start();

if (isset($_SESSION['percorsoPDF_CV'])) {
    unlink("../" . $_SESSION['percorsoPDF_CV']);
}
unset($_SESSION['percorsoPDF_CV']);
unset($_SESSION['pdf_to_deleteCV']);
unset($_SESSION['pdfCVCaricato']);
header('Location: ../lavora-con-noi.html');

