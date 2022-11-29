<?php

function prodotto_acquistato($cliente, $id, $tipo, $conn): bool
{
    $result = $conn->query("SELECT * FROM ordine WHERE cliente='$cliente'");
    while ($ordine = $result->fetch_assoc()) {
        $id_ordine = $ordine['id'];
        $result2 = $conn->query("SELECT * FROM prodotti_ordine WHERE id_ordine='$id_ordine'");
        while ($prod = $result2->fetch_assoc()) {
            if ($prod['prodotto'] == $id && $prod['tipo'] == $tipo) {
                return TRUE;
            }
        }
    }
    return FALSE;
}

function studente($email, $conn): bool
{
    $result1 = $conn->query("SELECT * FROM utente WHERE email='$email'");
    $utente = $result1->fetch_assoc();
    $idUtente = $utente['id'];
    $result2 = $conn->query("SELECT * FROM studente WHERE utente_s='$idUtente'");
    if ($result2->num_rows > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function trovaIdStudente($email, $conn): int
{
    $result1 = $conn->query("SELECT * FROM utente WHERE email='$email'");
    $utente = $result1->fetch_assoc();
    $idUtente = $utente['id'];
    $result2 = $conn->query("SELECT * FROM studente WHERE utente_s='$idUtente'");
    if ($result2->num_rows > 0) {
        $studente = $result2->fetch_assoc();
        return $studente['id'];
    } else {
        return - 1;
    }
}

function trovaIdInsegnante($email, $conn): int
{
    $result1 = $conn->query("SELECT * FROM utente WHERE email='$email'");
    $utente = $result1->fetch_assoc();
    $idUtente = $utente['id'];
    $result2 = $conn->query("SELECT * FROM insegnante WHERE utente_i='$idUtente'");
    $insegnante = $result2->fetch_assoc();
    return $insegnante['id'];
}

function trovaIdInsegnanteDaCorso($id_corso, $conn): int
{
    $result1 = $conn->query("SELECT * FROM corso WHERE id = '$id_corso'");
    $corso = $result1->fetch_assoc();
    return $corso['insegnante'];
}

function trovaArgomentoLezione($id_lez, $conn): int
{
    $result = $conn->query("SELECT * FROM lezione WHERE id='$id_lez'");
    $lez = $result->fetch_assoc();
    return $lez['arg_lez'];
}

function trovaArgomentoEsercizio($id_ex, $conn): int
{
    $result = $conn->query("SELECT * FROM esercizio WHERE id='$id_ex'");
    $ex = $result->fetch_assoc();
    return $ex['argomento'];
}

function trovaCorsoArgomento($id_arg, $conn): int
{
    $result = $conn->query("SELECT * FROM argomento WHERE id='$id_arg'");
    $arg = $result->fetch_assoc();
    return $arg['corso_arg'];
}

function trovaMateriaCorso($id_corso, $conn): int
{
    $result = $conn->query("SELECT * FROM corso WHERE id='$id_corso'");
    $corso = $result->fetch_assoc();
    return $corso['materia'];
}

function trovaAreaTematicaMateria($id_materia, $conn): int
{
    $result = $conn->query("SELECT * FROM materia WHERE id='$id_materia'");
    $materia = $result->fetch_assoc();
    return $materia['area_tematica'];
}

function trovaAreaTematicaLezione($id_lez, $conn): int
{
    $arg = trovaArgomentoLezione($id_lez, $conn);
    $corso = trovaCorsoArgomento($arg, $conn);
    $materia = trovaMateriaCorso($corso, $conn);
    return trovaAreaTematicaMateria($materia, $conn);
}

function trovaAreaTematicaEsercizio($id_ex, $conn): int
{
    $arg = trovaArgomentoEsercizio($id_ex, $conn);
    $corso = trovaCorsoArgomento($arg, $conn);
    $materia = trovaMateriaCorso($corso, $conn);
    return trovaAreaTematicaMateria($materia, $conn);
}

function trovaCorsoLezione($id_lez, $conn): int
{
    $result = $conn->query("SELECT * FROM lezione WHERE id='$id_lez'");
    $lez = $result->fetch_assoc();
    return $lez['corso_lez'];
    ;
}

function trovaCorsoEsercizio($id_ex, $conn): int
{
    $result = $conn->query("SELECT * FROM esercizio WHERE id='$id_ex'");
    $ex = $result->fetch_assoc();
    return $ex['corso_ex'];
    ;
}

function stampa_data($data)
{
    $anno = substr($data, 0, 4);
    $mese = substr($data, 5, 2);
    $giorno = substr($data, 8, 2);
    $ora = substr($data, 11, 5);
    $r = array();
    $r['anno'] = $anno;
    $r['mese'] = $mese;
    $r['giorno'] = $giorno;
    $r['ora'] = $ora;

    return $r;
}
?>