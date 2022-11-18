<?php

session_start();

if (isset($_SESSION['percorsoPDF_L'])) {
    unlink("../" . $_SESSION['percorsoPDF_L']);
}
unset($_SESSION['percorsoPDF_L']);
unset($_SESSION['pdfLCaricato']);

$id = $_GET['id'];
if ($id != - 1) {
    header('Location: ../modifica-file-lezione-' . $id . '.html');
}else if($id === - 1){
    header('Location: ../nuova-lezione.html');
}else{
    header('Location: ../nuova-lezione.html');
}