<?php
session_start();

if (isset($_SESSION['percorsoFoto'])) {
    unlink("../" . $_SESSION['percorsoFoto']);
}
unset($_SESSION['percorsoFoto']);
unset($_SESSION['to_delete']);
unset($_SESSION['FotoCaricata']);

if (isset($_GET['ret'])) {
    header('Location: ../modifica_foto_ins.html');
} else {
    header('Location: ../registrazione-insegnante-1.html');
}
