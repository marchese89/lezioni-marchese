<?php session_start();

if (isset($_SESSION['percorsoFotoCF'])) {
    unlink("../" . $_SESSION['percorsoFotoCF']);
}
unset($_SESSION['percorsoFotoCF']);
unset($_SESSION['to_deleteCF']);
unset($_SESSION['FotoCFCaricata']);
header('Location: ../registrazione-insegnante-3.html');

