<?php
session_start();

$id = $_GET['id'];

if (isset($_SESSION['percorsoPDF_SL'])) {
    unlink("../" . $_SESSION['percorsoPDF_SL']);
}
unset($_SESSION['percorsoPDF_SL']);
unset($_SESSION['pdfSLCaricato']);

header('Location: ../visualizza-richiesta-lezione-i-' . $id . '.html');
