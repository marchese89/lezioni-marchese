
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
        $nome_pdf = $_FILES['fileuploadFoto']['name'];
        $ext = end(explode(".", $nome_pdf));
        $data = date("Y_m_d_H_i_s");
        
        if (is_uploaded_file($_FILES['fileuploadFoto']['tmp_name'])) {

            $number = 1;
            
            while (file_exists($percorso . $number . '_' . $data . '.'. $ext)) {
                $number ++;
            }

            $nomeFile = "file_insegnanti/foto/" . $number . '_' . $data . '.'. $ext;

            if (! file_exists($percorso . $number  . '_' . $data . '.'. $ext)) {

                if (strlen($nomeFile) <= 244) {
                    if (move_uploaded_file($_FILES['fileuploadFoto']['tmp_name'], $percorso . $number . '_' . $data . '.'. $ext)) {
                        $_SESSION['percorsoFoto'] = "file_insegnanti/foto/" . $number . '_' . $data . '.'. $ext;
                        $_SESSION['fotoCaricata'] = "OK";
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
        $nome_pdf = $_FILES['fileuploadFotoDI']['name'];
        $ext = end(explode(".", $nome_pdf));
        $dim_ext = strlen($ext) + 1;
        $data = date("Y_m_d_H_i_s");
        
        if (is_uploaded_file($_FILES['fileuploadFotoDI']['tmp_name'])) {

            $number = 1;
            while (file_exists($percorso . $number . '_' . $data . '.'. $ext)) {
                $number ++;
            }

            $nomeFile = "file_insegnanti/doc_id/" . $number . '_' . $data . '.'. $ext;

            if (! file_exists($percorso . $number . '_' . $data . '.'. $ext)) {

                if (strlen($nomeFile) <= 244) {
                    if (move_uploaded_file($_FILES['fileuploadFotoDI']['tmp_name'], $percorso . $number . '_' . $data . '.'. $ext)) {
                        $_SESSION['percorsoFotoDI'] = "file_insegnanti/doc_id/" . $number . '_' . $data . '.'. $ext;
                        $_SESSION['fotoDICaricata'] = "OK";
                    } else {
                        $_SESSION['fotoDICaricata'] = "ERRORE";
                        $_SESSION['motivo_errore_DI'] = $_FILES['fileuploadFotoDI']['error'];
                    }
                } else {
                    $_SESSION['fotoDICaricata'] = "ERRORE";
                    $_SESSION['motivo_errore_Foto'] = "nome file troppo lungo";
                }
            } else {
                $_SESSION['fotoDICaricata'] = "ERRORE";
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
        $nome_pdf = $_FILES['fileuploadFotoCF']['name'];
        $ext = end(explode(".", $nome_pdf));
        $data = date("Y_m_d_H_i_s");
        
        if (is_uploaded_file($_FILES['fileuploadFotoCF']['tmp_name'])) {

            $number = 1;
            while (file_exists($percorso . $number . '_' . $data . '.'. $ext)) {
                $number ++;
            }

            $nomeFile = "file_insegnanti/codice_f/" . $number . '_' . $data . '.'. $ext;

            if (! file_exists($percorso . $number)) {

                if (strlen($nomeFile) <= 244) {
                    if (move_uploaded_file($_FILES['fileuploadFotoCF']['tmp_name'], $percorso . $number . '_' . $data . '.'. $ext)) {
                        $_SESSION['percorsoFotoCF'] = "file_insegnanti/codice_f/" . $number . '_' . $data . '.'. $ext;
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
        
        $number = 1;
        while (file_exists($percorso . $number . '_' . $data . '.'. $ext)) {
            $number ++;
        }
        
        $nomeFile = "file_insegnanti/titolo_studio/" . $number . '_' . $data . '.'. $ext;
        
        if (is_uploaded_file($_FILES['fileuploadPDF_TS']['tmp_name'])) {

            

            if (! file_exists($percorso . $_FILES['fileuploadPDF_TS']['name'])) {

                if (strlen($nomeFile) <= 244) {
                    if (move_uploaded_file($_FILES['fileuploadPDF_TS']['tmp_name'], $percorso . $number . '_' . $data . '.'. $ext)) {
                        $_SESSION['percorsoPDF_TS'] = $nomeFile;
                        $_SESSION['pdfTSCaricato'] = "OK";
                    } else {
                        $_SESSION['pdfTSCaricato'] = "ERRORE";
                        $_SESSION['motivo_errore_pdfTS'] = $_FILES['fileuploadPDF_TS']['error'];
                    }
                } else {
                    $_SESSION['pdfTSCaricato'] = "ERRORE";
                    $_SESSION['motivo_errore_pdfTS'] = "nome file troppo lungo";
                }
            } else {
                $_SESSION['pdfTSCaricato'] = "ERRORE";
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

    $ok = FALSE;
    if ($_FILES['fileuploadPDF_CV']['type'] === "application/pdf") {
        $ok = TRUE;
    } else {
        $ok = FALSE;
    }
    if ($ok == TRUE) {
        $percorso = "../file_insegnanti/cv/";
        $nome_pdf = $_FILES['fileuploadPDF_CV']['name'];
        $ext = end(explode(".", $nome_pdf));
        $dim_ext = strlen($ext) + 1;
        $data = date("Y_m_d_H_i_s");
        $number = 1;
        while (file_exists($percorso  . $number . '_' . $data . '.'. $ext)) {
            $number ++;
        }
        
        
        if (is_uploaded_file($_FILES['fileuploadPDF_CV']['tmp_name'])) {

            $nomeFile = "file_insegnanti/cv/"  . $number . '_' . $data . '.'. $ext;

            if (! file_exists($percorso . $_FILES['fileuploadPDF_CV']['name'])) {

                if (strlen($nomeFile) <= 244) {
                    if (move_uploaded_file($_FILES['fileuploadPDF_CV']['tmp_name'], $percorso  . $number . '_' . $data . '.'. $ext)) {
                        $_SESSION['percorsoPDF_CV'] = $nomeFile;
                        $_SESSION['pdfCVCaricato'] = "OK";
                    } else {
                        $_SESSION['pdfCVCaricato'] = "ERRORE";
                        $_SESSION['motivo_errore_pdfCV'] = $_FILES['fileuploadPDF_CV']['error'];
                    }
                } else {
                    $_SESSION['pdfCVCaricato'] = "ERRORE";
                    $_SESSION['motivo_errore_pdfCV'] = "nome file troppo lungo";
                }
            } else {
                $_SESSION['pdfCVCaricato'] = "ERRORE";
                $sql = "SELECT * FROM insegnante WHERE cv='$nomeFile'";
                $res = $conn->query($sql);
                if ($res->num_rows == 0) {
                    $_SESSION['pdf_to_deleteCV'] = 'ok';
                    $_SESSION['percorsoPDF_CV'] = $nomeFile;
                }
                $_SESSION['motivo_errore_pdfCV'] = "File gi&agrave; presente";
            }
        } else {
            $_SESSION['pdfCVCaricato'] = "ERRORE";
            $_SESSION['motivo_errore_pdfCV'] = $_FILES['fileuploadPDF_CV']['error'];
        }
    } else {
        $_SESSION['pdfCVCaricato'] = "ERRORE";
        $_SESSION['motivo_errore_pdfCV'] = "Formato file non supportato";
    }
}


if (isset($_POST["UploadPDF_PL"])) {
    
    $ok = FALSE;
    if ($_FILES['fileuploadPDF_PL']['type'] === "application/pdf" || getimagesize($_FILES['fileuploadPDF_PL']['tmp_name'])) {
        $ok = TRUE;
    } else {
        $ok = FALSE;
    }
    if ($ok == TRUE) {
        $percorso = "../file_lezioni/";
        $nome_pdf = $_FILES['fileuploadPDF_PL']['name'];
        $ext = end(explode(".", $nome_pdf));
        $dim_ext = strlen($ext) + 1;
        $data = date("Y_m_d_H_i_s");
        $number = 1;
        while (file_exists($percorso . $number . '_' . $data .  '.' . $ext)) {
            $number ++;
        }
        
        
        if (is_uploaded_file($_FILES['fileuploadPDF_PL']['tmp_name'])) {
            
            $nomeFile = "file_lezioni/" . $number .  '_' . $data . '.' . $ext;
            
            if (! file_exists($percorso . $_FILES['fileuploadPDF_PL']['name'])) {
                
                if (strlen($nomeFile) <= 244) {
                    if (move_uploaded_file($_FILES['fileuploadPDF_PL']['tmp_name'], $percorso . $number . '_' . $data .  '.' . $ext)) {
                        $_SESSION['percorsoPDF_PL'] = $nomeFile;
                        $_SESSION['pdfPLCaricato'] = "OK";
                    } else {
                        $_SESSION['pdfPLCaricato'] = "ERRORE";
                        $_SESSION['motivo_errore_pdfPL'] = $_FILES['fileuploadPDF_PL']['error'];
                    }
                } else {
                    $_SESSION['pdfPLCaricato'] = "ERRORE";
                    $_SESSION['motivo_errore_pdfPL'] = "nome file troppo lungo";
                }
            } else {
                $_SESSION['pdfPLCaricato'] = "ERRORE";
                $_SESSION['motivo_errore_pdfPL'] = "File gi&agrave; presente";
            }
        } else {
            $_SESSION['pdfPLCaricato'] = "ERRORE";
            $_SESSION['motivo_errore_pdfPL'] = $_FILES['fileuploadPDF_PL']['error'];
        }
    } else {
        $_SESSION['pdfPLCaricato'] = "ERRORE";
        $_SESSION['motivo_errore_pdfPL'] = "Formato file non supportato";
    }
}


if (isset($_POST["UploadPDF_L"])) {
    
    $ok = FALSE;
    if ($_FILES['fileuploadPDF_L']['type'] === "application/pdf" || getimagesize($_FILES['fileuploadPDF_L']['tmp_name'])) {
        $ok = TRUE;
    } else {
        $ok = FALSE;
    }
    if ($ok == TRUE) {
        $percorso = "../file_lezioni/";
        $nome_pdf = $_FILES['fileuploadPDF_L']['name'];
        $ext = end(explode(".", $nome_pdf));
        $dim_ext = strlen($ext) + 1;
        $data = date("Y_m_d_H_i_s");
        $number = 1;
        while (file_exists($percorso . $number . '_' . $data . '.' . $ext)) {
            $number ++;
        }
        
        
        if (is_uploaded_file($_FILES['fileuploadPDF_L']['tmp_name'])) {
            
            $nomeFile = "file_lezioni/" . $number .  '_' . $data . '.' . $ext;
            
            if (! file_exists($percorso . $_FILES['fileuploadPDF_L']['name'])) {
                
                if (strlen($nomeFile) <= 244) {
                    if (move_uploaded_file($_FILES['fileuploadPDF_L']['tmp_name'], $percorso . $number . '_' . $data . '.' . $ext)) {
                        $_SESSION['percorsoPDF_L'] = $nomeFile;
                        $_SESSION['pdfLCaricato'] = "OK";
                    } else {
                        $_SESSION['pdfLCaricato'] = "ERRORE";
                        $_SESSION['motivo_errore_pdfL'] = $_FILES['fileuploadPDF_L']['error'];
                    }
                } else {
                    $_SESSION['pdfLCaricato'] = "ERRORE";
                    $_SESSION['motivo_errore_pdfL'] = "nome file troppo lungo";
                }
            } else {
                $_SESSION['pdfLCaricato'] = "ERRORE";
                $_SESSION['motivo_errore_pdfL'] = "File gi&agrave; presente";
            }
        } else {
            $_SESSION['pdfLCaricato'] = "ERRORE";
            $_SESSION['motivo_errore_pdfL'] = $_FILES['fileuploadPDF_L']['error'];
        }
    } else {
        $_SESSION['pdfLCaricato'] = "ERRORE";
        $_SESSION['motivo_errore_pdfL'] = "Formato file non supportato";
    }
}


if (isset($_POST["UploadPDF_TE"])) {
    
    $ok = FALSE;
    if ($_FILES['fileuploadPDF_TE']['type'] === "application/pdf" || getimagesize($_FILES['fileuploadPDF_TE']['tmp_name'])) {
        $ok = TRUE;
    } else {
        $ok = FALSE;
    }
    if ($ok == TRUE) {
        $percorso = "../file_esercizi/";
        $nome_pdf = $_FILES['fileuploadPDF_TE']['name'];
        $ext = end(explode(".", $nome_pdf));
        $dim_ext = strlen($ext) + 1;
        $data = date("Y_m_d_H_i_s");
        $number = 1;
        while (file_exists($percorso . $number . '_' . $data .  '.' . $ext)) {
            $number ++;
        }
        
        
        if (is_uploaded_file($_FILES['fileuploadPDF_TE']['tmp_name'])) {
            
            $nomeFile = "file_esercizi/" . $number . '_' . $data . '.' . $ext;
            
            if (! file_exists($percorso . $_FILES['fileuploadPDF_TE']['name'])) {
                
                if (strlen($nomeFile) <= 244) {
                    if (move_uploaded_file($_FILES['fileuploadPDF_TE']['tmp_name'], $percorso . $number . '_' . $data . '.' . $ext)) {
                        $_SESSION['percorsoPDF_TE'] = $nomeFile;
                        $_SESSION['pdfTECaricato'] = "OK";
                    } else {
                        $_SESSION['pdfTECaricato'] = "ERRORE";
                        $_SESSION['motivo_errore_pdfTE'] = $_FILES['fileuploadPDF_TE']['error'];
                    }
                } else {
                    $_SESSION['pdfTECaricato'] = "ERRORE";
                    $_SESSION['motivo_errore_pdfTE'] = "nome file troppo lungo";
                }
            } else {
                $_SESSION['pdfTECaricato'] = "ERRORE";
                $_SESSION['motivo_errore_pdfTE'] = "File gi&agrave; presente";
            }
        } else {
            $_SESSION['pdfTECaricato'] = "ERRORE";
            $_SESSION['motivo_errore_pdfTE'] = $_FILES['fileuploadPDF_TE']['error'];
        }
    } else {
        $_SESSION['pdfTECaricato'] = "ERRORE";
        $_SESSION['motivo_errore_pdfTE'] = "Formato file non supportato";
    }
}

if (isset($_POST["UploadPDF_SE"])) {
    
    $ok = FALSE;
    if ($_FILES['fileuploadPDF_SE']['type'] === "application/pdf" || getimagesize($_FILES['fileuploadPDF_SE']['tmp_name'])) {
        $ok = TRUE;
    } else {
        $ok = FALSE;
    }
    if ($ok == TRUE) {
        $percorso = "../file_esercizi/";
        $nome_pdf = $_FILES['fileuploadPDF_SE']['name'];
        $ext = end(explode(".", $nome_pdf));
        $dim_ext = strlen($ext) + 1;
        $data = date("Y_m_d_H_i_s");
        $number = 1;
        while (file_exists($percorso . $number .  '_' . $data . '.' . $ext)) {
            $number ++;
        }
        
        
        if (is_uploaded_file($_FILES['fileuploadPDF_SE']['tmp_name'])) {
            
            $nomeFile = "file_esercizi/" . $number .  '_' . $data . '.' . $ext;
            
            if (! file_exists($percorso . $_FILES['fileuploadPDF_SE']['name'])) {
                
                if (strlen($nomeFile) <= 244) {
                    if (move_uploaded_file($_FILES['fileuploadPDF_SE']['tmp_name'], $percorso . $number .  '_' . $data . '.' . $ext)) {
                        $_SESSION['percorsoPDF_SE'] = $nomeFile;
                        $_SESSION['pdfSECaricato'] = "OK";
                    } else {
                        $_SESSION['pdfSECaricato'] = "ERRORE";
                        $_SESSION['motivo_errore_pdfSE'] = $_FILES['fileuploadPDF_SE']['error'];
                    }
                } else {
                    $_SESSION['pdfSECaricato'] = "ERRORE";
                    $_SESSION['motivo_errore_pdfSE'] = "nome file troppo lungo";
                }
            } else {
                $_SESSION['pdfSECaricato'] = "ERRORE";
                $_SESSION['motivo_errore_pdfSE'] = "File gi&agrave; presente";
            }
        } else {
            $_SESSION['pdfSECaricato'] = "ERRORE";
            $_SESSION['motivo_errore_pdfSE'] = $_FILES['fileuploadPDF_SE']['error'];
        }
    } else {
        $_SESSION['pdfSECaricato'] = "ERRORE";
        $_SESSION['motivo_errore_pdfSE'] = "Formato file non supportato";
    }
}


if (isset($_POST["UploadPDF_RL"])) {
    
    $ok = FALSE;
    if ($_FILES['fileuploadPDF_RL']['type'] === "application/pdf" || getimagesize($_FILES['fileuploadPDF_RL']['tmp_name'])) {
        $ok = TRUE;
    } else {
        $ok = FALSE;
    }
    if ($ok == TRUE) {
        $percorso = "../file_richieste_lezioni/";
        $nome_pdf = $_FILES['fileuploadPDF_RL']['name'];
        $ext = end(explode(".", $nome_pdf));
        $dim_ext = strlen($ext) + 1;
        $data = date("Y_m_d_H_i_s");
        $number = 1;
        while (file_exists($percorso . $number .  '_' . $data . '.' . $ext)) {
            $number ++;
        }
        
        
        if (is_uploaded_file($_FILES['fileuploadPDF_RL']['tmp_name'])) {
            
            $nomeFile = "file_richieste_lezioni/" . $number .  '_' . $data . '.' . $ext;
            
            if (! file_exists($percorso . $_FILES['fileuploadPDF_RL']['name'])) {
                
                if (strlen($nomeFile) <= 244) {
                    if (move_uploaded_file($_FILES['fileuploadPDF_RL']['tmp_name'], $percorso . $number .  '_' . $data . '.' . $ext)) {
                        $_SESSION['percorsoPDF_RL'] = $nomeFile;
                        $_SESSION['pdfRLCaricato'] = "OK";
                    } else {
                        $_SESSION['pdfRLCaricato'] = "ERRORE";
                        $_SESSION['motivo_errore_pdfRL'] = $_FILES['fileuploadPDF_RL']['error'];
                    }
                } else {
                    $_SESSION['pdfRLCaricato'] = "ERRORE";
                    $_SESSION['motivo_errore_pdfRL'] = "nome file troppo lungo";
                }
            } else {
                $_SESSION['pdfRLCaricato'] = "ERRORE";
                $_SESSION['motivo_errore_pdfRL'] = "File gi&agrave; presente";
            }
        } else {
            $_SESSION['pdfRLCaricato'] = "ERRORE";
            $_SESSION['motivo_errore_pdfRL'] = $_FILES['fileuploadPDF_RL']['error'];
        }
    } else {
        $_SESSION['pdfRLCaricato'] = "ERRORE";
        $_SESSION['motivo_errore_pdfRL'] = "Formato file non supportato";
    }
}

if (isset($_POST["UploadPDF_SL"])) {
    
    $ok = FALSE;
    if ($_FILES['fileuploadPDF_SL']['type'] === "application/pdf" || getimagesize($_FILES['fileuploadPDF_SL']['tmp_name'])) {
        $ok = TRUE;
    } else {
        $ok = FALSE;
    }
    if ($ok == TRUE) {
        $percorso = "../file_richieste_lezioni/";
        $nome_pdf = $_FILES['fileuploadPDF_SL']['name'];
        $ext = end(explode(".", $nome_pdf));
        $dim_ext = strlen($ext) + 1;
        $data = date("Y_m_d_H_i_s");
        $number = 1;
        while (file_exists($percorso . $number .  '_' . $data . '.' . $ext)) {
            $number ++;
        }
        
        
        if (is_uploaded_file($_FILES['fileuploadPDF_SL']['tmp_name'])) {
            
            $nomeFile = "file_richieste_lezioni/" . $number .  '_' . $data . '.' . $ext;
            
            if (! file_exists($percorso . $_FILES['fileuploadPDF_SL']['name'])) {
                
                if (strlen($nomeFile) <= 244) {
                    if (move_uploaded_file($_FILES['fileuploadPDF_SL']['tmp_name'], $percorso . $number .  '_' . $data . '.' . $ext)) {
                        $_SESSION['percorsoPDF_SL'] = $nomeFile;
                        $_SESSION['pdfSLCaricato'] = "OK";
                    } else {
                        $_SESSION['pdfSLCaricato'] = "ERRORE";
                        $_SESSION['motivo_errore_pdfSL'] = $_FILES['fileuploadPDF_SL']['error'];
                    }
                } else {
                    $_SESSION['pdfSLCaricato'] = "ERRORE";
                    $_SESSION['motivo_errore_pdfSL'] = "nome file troppo lungo";
                }
            } else {
                $_SESSION['pdfSLCaricato'] = "ERRORE";
                $_SESSION['motivo_errore_pdfSL'] = "File gi&agrave; presente";
            }
        } else {
            $_SESSION['pdfSLCaricato'] = "ERRORE";
            $_SESSION['motivo_errore_pdfSL'] = $_FILES['fileuploadPDF_SL']['error'];
        }
    } else {
        $_SESSION['pdfSLCaricato'] = "ERRORE";
        $_SESSION['motivo_errore_pdfSL'] = "Formato file non supportato";
    }
}

