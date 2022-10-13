
<?php
session_start();
include '../config/mysql-config.php';

if (isset($_POST["UploadFoto"])) {
    // validiamo il file

    $check = getimagesize($_FILES['fileuploadFoto']['tmp_name']);
    $ok = FALSE;
    if ($check !== false) {
        $ok = TRUE;
    } else {
        $ok = FALSE;
    }
    if ($ok == TRUE) {

        $percorso = "../file_insegnanti/foto/";
        if (is_uploaded_file($_FILES['fileuploadFoto']['tmp_name'])) {

            $number = 1;
            $nomeFoto = "";
            while (file_exists($percorso . $number)) {
                $number ++;
            }

            $nomeFile = "file_insegnanti/foto/" . $number;

            if (! file_exists($percorso . $number)) {

                if (strlen($nomeFile) <= 244) {
                    if (move_uploaded_file($_FILES['fileuploadFoto']['tmp_name'], $percorso . $number)) {
                        $_SESSION['percorsoFoto'] = "file_insegnanti/foto/" . $number;
                        $_SESSION['fotoCaricata'] = "OK";
                        echo 'foto caricata';
                    } else {
                        $_SESSION['fotoCaricata'] = "ERRORE";
                        $_SESSION['motivo_errore_Foto'] = $_FILES['fileuploadFoto']['error'];
                    }
                } else {
                    $_SESSION['fotoCaricata'] = "ERRORE";
                    $_SESSION['motivo_errore_Foto'] = "nome file troppo lungo";
                }
            } else {
                $_SESSION['fotoCaricata'] = "ERRORE";
                // vediamo se c'è già un volantino con la stessa Foto
                $sql = "SELECT * FROM insegnante WHERE foto='$nomeFile'";
                $res = $conn->query($sql);
                if ($res->num_rows == 0) {
                    $_SESSION['to_delete'] = 'ok';
                    $_SESSION['percorsoFoto'] = $nomeFile;
                }
                $_SESSION['motivo_errore_Foto'] = "File gi&agrave; presente";
            }
        } else {
            $_SESSION['fotoCaricata'] = "ERRORE";
            $_SESSION['motivo_errore_Foto'] = $_FILES['fileuploadFoto']['error'];
        }
    } else {
        $_SESSION['fotoCaricata'] = "ERRORE";
        $_SESSION['motivo_errore_Foto'] = "Formato file non supportato";
    }
}

if (isset($_POST["UploadFotoDI"])) {

    // validiamo il file

    $check = getimagesize($_FILES['fileuploadFotoDI']['tmp_name']);
    $ok = FALSE;
    if ($check !== false) {
        $ok = TRUE;
    } else {
        $ok = FALSE;
    }
    if ($ok == TRUE) {

        $percorso = "../file_insegnanti/doc_id/";
        if (is_uploaded_file($_FILES['fileuploadFotoDI']['tmp_name'])) {

            $number = 1;
            $nomeFoto = "";
            while (file_exists($percorso . $number)) {
                $number ++;
            }

            $nomeFile = "file_insegnanti/doc_id/" . $number;

            if (! file_exists($percorso . $number)) {

                if (strlen($nomeFile) <= 244) {
                    if (move_uploaded_file($_FILES['fileuploadFotoDI']['tmp_name'], $percorso . $number)) {
                        $_SESSION['percorsoFotoDI'] = "file_insegnanti/doc_id/" . $number;
                        $_SESSION['fotoDICaricata'] = "OK";
                    } else {
                        $_SESSION['fotoDICaricata'] = "ERRORE";
                        $_SESSION['motivo_errore_Foto'] = $_FILES['fileuploadFotoDI']['error'];
                    }
                } else {
                    $_SESSION['fotoDICaricata'] = "ERRORE";
                    $_SESSION['motivo_errore_Foto'] = "nome file troppo lungo";
                }
            } else {
                $_SESSION['fotoDICaricata'] = "ERRORE";
                // vediamo se c'è già un volantino con la stessa Foto
                $sql = "SELECT * FROM insegnante WHERE doc_id='$nomeFile'";
                $res = $conn->query($sql);
                if ($res->num_rows == 0) {
                    $_SESSION['to_delete'] = 'ok';
                    $_SESSION['percorsoFotoDI'] = $nomeFile;
                }
                $_SESSION['motivo_errore_DI'] = "File gi&agrave; presente";
            }
        } else {
            $_SESSION['fotoDICaricata'] = "ERRORE";
            $_SESSION['motivo_errore_DI'] = $_FILES['fileuploadFoto']['error'];
        }
    } else {
        $_SESSION['fotoDICaricata'] = "ERRORE";
        $_SESSION['motivo_errore_DI'] = "Formato file non supportato";
    }
}

if (isset($_POST["UploadFotoCF"])) {

    // validiamo il file

    $check = getimagesize($_FILES['fileuploadFotoCF']['tmp_name']);
    $ok = FALSE;
    if ($check !== false) {
        $ok = TRUE;
    } else {
        $ok = FALSE;
    }
    if ($ok == TRUE) {

        $percorso = "../file_insegnanti/codice_f/";
        if (is_uploaded_file($_FILES['fileuploadFotoCF']['tmp_name'])) {

            $number = 1;
            $nomeFoto = "";
            while (file_exists($percorso . $number)) {
                $number ++;
            }

            $nomeFile = "file_insegnanti/codice_f/" . $number;

            if (! file_exists($percorso . $number)) {

                if (strlen($nomeFile) <= 244) {
                    if (move_uploaded_file($_FILES['fileuploadFotoCF']['tmp_name'], $percorso . $number)) {
                        $_SESSION['percorsoFotoCF'] = "file_insegnanti/codice_f/" . $number;
                        $_SESSION['fotoCFCaricata'] = "OK";
                    } else {
                        $_SESSION['fotoCFCaricata'] = "ERRORE";
                        $_SESSION['motivo_errore_CF'] = $_FILES['fileuploadFotoCF']['error'];
                    }
                } else {
                    $_SESSION['fotoCFCaricata'] = "ERRORE";
                    $_SESSION['motivo_errore_CF'] = "nome file troppo lungo";
                }
            } else {
                $_SESSION['fotoCFCaricata'] = "ERRORE";
                // vediamo se c'è già un volantino con la stessa Foto
                $sql = "SELECT * FROM insegnante WHERE codice_fiscale='$nomeFile'";
                $res = $conn->query($sql);
                if ($res->num_rows == 0) {
                    $_SESSION['to_delete'] = 'ok';
                    $_SESSION['percorsoFotoCF'] = $nomeFile;
                }
                $_SESSION['motivo_errore_CF'] = "File gi&agrave; presente";
            }
        } else {
            $_SESSION['fotoCFCaricata'] = "ERRORE";
            $_SESSION['motivo_errore_CF'] = $_FILES['fileuploadFotoCF']['error'];
        }
    } else {
        $_SESSION['fotoCFCaricata'] = "ERRORE";
        $_SESSION['motivo_errore_CF'] = "Formato file non supportato";
    }
}

if (isset($_POST["UploadPDF_TS"])) {

    $ok = FALSE;
    if ($_FILES['fileuploadPDF_TS']['type'] === "application/pdf") {
        $ok = TRUE;
    } else {
        $ok = FALSE;
    }
    if ($ok == TRUE) {
        $percorso = "../file_insegnanti/titolo_studio/";
        $nome_pdf = $_FILES['fileuploadPDF_TS']['name'];
        $ext = end(explode(".", $nome_pdf));
        $dim_ext = strlen($ext) + 1;
        $senzaExt = substr($_FILES['fileuploadPDF_TS']['name'], 0, - $dim_ext);
        $data = date("Y_m_d_H_i_s");
        if (is_uploaded_file($_FILES['fileuploadPDF_TS']['tmp_name'])) {

            $nomeFile = "file_insegnanti/titolo_studio/" . $senzaExt . $data . '.' . $ext;

            if (! file_exists($percorso . $_FILES['fileuploadPDF_TS']['name'])) {

                if (strlen($nomeFile) <= 244) {
                    if (move_uploaded_file($_FILES['fileuploadPDF_TS']['tmp_name'], $percorso . $senzaExt . $data . '.' . $ext)) {
                        $_SESSION['percorsoPDF_TS'] = $nomeFile;
                        $_SESSION['pdfTSCaricato'] = "OK";
                    } else {
                        $_SESSION['pdfTSCaricato'] = "ERRORE";
                        $_SESSION['motivo_errore_pdfTS'] = $_FILES['fileuploadPDF']['error'];
                    }
                } else {
                    $_SESSION['pdfTSCaricato'] = "ERRORE";
                    $_SESSION['motivo_errore_pdfTS'] = "nome file troppo lungo";
                }
            } else {
                $_SESSION['pdfTSCaricato'] = "ERRORE";
                // vediamo se il pdf è collegato ad un altro volantino
                $sql = "SELECT * FROM insegnante WHERE titolo_di_studio='$nomeFile'";
                $res = $conn->query($sql);
                if ($res->num_rows == 0) {
                    $_SESSION['pdf_to_deleteTS'] = 'ok';
                    $_SESSION['percorsoPDF_TS'] = $nomeFile;
                }
                $_SESSION['motivo_errore_pdfTS'] = "File gi&agrave; presente";
            }
        } else {
            $_SESSION['pdfTSCaricato'] = "ERRORE";
            $_SESSION['motivo_errore_pdfTS'] = $_FILES['fileuploadPDF_TS']['error'];
        }
    } else {
        $_SESSION['pdfTSCaricato'] = "ERRORE";
        $_SESSION['motivo_errore_pdfTS'] = "Formato file non supportato";
    }
}

if (isset($_POST["UploadPDF_CV"])) {

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $_FILES['fileuploadPDF']['tmp_name']);
    $ok = FALSE;
    switch ($mime) {
        case 'application/pdf':
            $ok = TRUE;
            break;
        default:
            $ok = FALSE;
    }
    if ($ok == TRUE) {
        $percorso = "../volantiniPDF/";
        $nome_pdf = $_FILES['fileuploadPDF']['name'];
        $ext = end(explode(".", $nome_pdf));
        $dim_ext = strlen($ext) + 1;
        $senzaExt = substr($_FILES['fileuploadPDF']['name'], 0, - $dim_ext);
        $data = date("Y_m_d_H_i_s");
        if (is_uploaded_file($_FILES['fileuploadPDF']['tmp_name'])) {

            $nomeFile = "volantiniPDF/" . $senzaExt . $data . '.' . $ext;

            if (! file_exists($percorso . $_FILES['fileuploadPDF']['name'])) {

                if (strlen($nomeFile) <= 244) {
                    if (move_uploaded_file($_FILES['fileuploadPDF']['tmp_name'], $percorso . $senzaExt . $data . '.' . $ext)) {
                        $_SESSION['percorsoPDF'] = $nomeFile;
                        $_SESSION['pdfCaricato'] = "OK";
                    } else {
                        $_SESSION['pdfCaricato'] = "ERRORE";
                        $_SESSION['motivo_errore_pdf'] = $_FILES['fileuploadPDF']['error'];
                    }
                } else {
                    $_SESSION['pdfCaricato'] = "ERRORE";
                    $_SESSION['motivo_errore_pdf'] = "nome file troppo lungo";
                }
            } else {
                $_SESSION['pdfCaricato'] = "ERRORE";
                // vediamo se il pdf è collegato ad un altro volantino
                $sql = "SELECT * FROM volantino WHERE percorso_pdf='$nomeFile'";
                $res = $conn->query($sql);
                if ($res->num_rows == 0) {
                    $_SESSION['pdf_to_delete'] = 'ok';
                    $_SESSION['percorsoPDF'] = $nomeFile;
                }
                $_SESSION['motivo_errore_pdf'] = "File gi&agrave; presente";
            }
        } else {
            $_SESSION['pdfCaricato'] = "ERRORE";
            $_SESSION['motivo_errore_pdf'] = $_FILES['fileuploadPDF']['error'];
        }
    } else {
        $_SESSION['pdfCaricato'] = "ERRORE";
        $_SESSION['motivo_errore_pdf'] = "Formato file non supportato";
    }
}
