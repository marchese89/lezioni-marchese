<?php session_start();

if (isset($_SESSION['percorsoFotoDI'])) {
    unlink("../" . $_SESSION['percorsoFotoDI']);
}
unset($_SESSION['percorsoFotoDI']);
unset($_SESSION['to_deleteDI']);
unset($_SESSION['FotoDICaricata']);
header('Location: ../lavora-con-noi.html');

