<?php session_start();

if (isset($_SESSION['percorsoFoto'])) {
    unlink("../" . $_SESSION['percorsoFoto']);
}
unset($_SESSION['percorsoFoto']);
unset($_SESSION['to_delete']);
unset($_SESSION['FotoCaricata']);
header('Location: ../lavora-con-noi.html');
