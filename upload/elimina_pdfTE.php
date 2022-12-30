<?php
session_start();

if (isset($_SESSION['percorsoPDF_TE'])) {
    unlink("../" . $_SESSION['percorsoPDF_TE']);
}
unset($_SESSION['percorsoPDF_TE']);
unset($_SESSION['pdfTECaricato']);

$id = $_GET['id'];
$corso = $_GET['id_corso'];
if ($id != - 1) {
    if (isset($_GET['return'])) {
        header('Location: ../modifica-file-t-esercizio-' . $corso . '-' . $id . '.html');
    } 
} else {
    header('Location: ../nuovo-esercizio.html');
}


