<?php session_start();

if (isset($_SESSION['percorsoPDF_SE'])) {
    unlink("../" . $_SESSION['percorsoPDF_SE']);
}
unset($_SESSION['percorsoPDF_SE']);
unset($_SESSION['pdfSECaricato']);

$id = $_GET['id'];
$corso = $_GET['id_corso'];
if ($id != - 1) {
    if (isset($_GET['return'])) {
        header('Location: ../modifica-file-s-esercizio-' . $corso . '-' . $id . '.html');
    }
} else {
    header('Location: ../nuovo-esercizio.html');
}

