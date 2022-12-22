<?php session_start();

if (isset($_SESSION['percorsoPDF_PL'])) {
    unlink("../" . $_SESSION['percorsoPDF_PL']);
}
unset($_SESSION['percorsoPDF_PL']);
unset($_SESSION['pdfPLCaricato']);

$id = $_GET['id'];
$corso = $_GET['id_corso'];
if ($id != - 1) {
    
    if(isset($_GET['return'])){;
        header('Location: ../modifica-file-p-lezione-' . $corso .'-'. $id . '.html');
    }else{
        header('Location: ../modifica-file-lezione-' . $id . '.html');
    }
}else{
    header('Location: ../nuova-lezione.html');
}