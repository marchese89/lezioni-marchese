<?php

session_start();

if (isset($_SESSION['percorsoPDF_RL'])) {
    unlink("../" . $_SESSION['percorsoPDF_RL']);
}
unset($_SESSION['percorsoPDF_RL']);
unset($_SESSION['pdfRLCaricato']);


header('Location: ../lezioni-su-richiesta.html');
