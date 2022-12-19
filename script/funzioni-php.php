<?php

function prodotto_acquistato($cliente, $id, $tipo, $conn): bool
{
    $conn->query("LOCK TABLES ordine READ, prodotti_ordine READ");
    $result = $conn->query("SELECT * FROM ordine WHERE cliente='$cliente'");
    while ($ordine = $result->fetch_assoc()) {
        $id_ordine = $ordine['id'];
        $result2 = $conn->query("SELECT * FROM prodotti_ordine WHERE id_ordine='$id_ordine'");
        while ($prod = $result2->fetch_assoc()) {
            if ($prod['prodotto'] == $id && $prod['tipo'] == $tipo) {
                $conn->query("UNLOCK TABLES");
                return TRUE;
            }
        }
    }
    $conn->query("UNLOCK TABLES");
    return FALSE;
}

function studente($email, $conn): bool
{
    $conn->query("LOCK TABLES utente READ, studente READ");
    $result1 = $conn->query("SELECT * FROM utente WHERE email='$email'");
    $utente = $result1->fetch_assoc();
    $idUtente = $utente['id'];
    $result2 = $conn->query("SELECT * FROM studente WHERE utente_s='$idUtente'");

    if ($result2->num_rows > 0) {
        $conn->query("UNLOCK TABLES");
        return TRUE;
    } else {
        $conn->query("UNLOCK TABLES");
        return FALSE;
    }
}

function trovaIdStudente($email, $conn): int
{
    $conn->query("LOCK TABLES utente READ, studente READ");
    $result1 = $conn->query("SELECT * FROM utente WHERE email='$email'");
    $utente = $result1->fetch_assoc();
    $idUtente = $utente['id'];
    $result2 = $conn->query("SELECT * FROM studente WHERE utente_s='$idUtente'");

    if ($result2->num_rows > 0) {
        $studente = $result2->fetch_assoc();
        $conn->query("UNLOCK TABLES");
        return $studente['id'];
    } else {
        $conn->query("UNLOCK TABLES");
        return - 1;
    }
}

function trovaIdInsegnante($email, $conn): int
{
    $conn->query("LOCK TABLES utente READ, insegnante READ");
    $result1 = $conn->query("SELECT * FROM utente WHERE email='$email'");
    $utente = $result1->fetch_assoc();
    $idUtente = $utente['id'];
    $result2 = $conn->query("SELECT * FROM insegnante WHERE utente_i='$idUtente'");
    $insegnante = $result2->fetch_assoc();
    $conn->query("UNLOCK TABLES");
    return $insegnante['id'];
}

function trovaIdInsegnanteDaCorso($id_corso, $conn): int
{
    $conn->query("LOCK TABLES corso READ");
    $result1 = $conn->query("SELECT * FROM corso WHERE id = '$id_corso'");
    $corso = $result1->fetch_assoc();
    $conn->query("UNLOCK TABLES");
    return $corso['insegnante'];
}

function punteggioInsegnante($id_corso, $conn): float
{
    $conn->query("LOCK TABLES feedback READ");
    $id_ins = trovaIdInsegnanteDaCorso($id_corso, $conn);
    $result = $conn->query("SELECT  * FROM feedback");
    $cont = 0;
    $somma = 0;
    while ($feed = $result->fetch_assoc()) {
        $tipo = $feed['tipo_prodotto'];
        $id_prod = $feed['prodotto'];
        $punteggio = $feed['punteggio'];
        $ins_prod = 0;
        switch ($tipo) {
            case 0:
                $ins_prod = trovaIdInsegnanteDaLezione($id_prod, $conn);
                break;
            case 2:
                $ins_prod = trovaIdInsegnanteDaEsercizio($id_prod, $conn);
                break;
            case 5:
                $ins_prod = trovaIdInsegnanteDaLezioneSuRichiesta($id_prod, $conn);
                break;
            default:
                break;
        }
        if ($id_ins == $ins_prod) {
            $cont = $cont + 1;
            $somma = $somma + $punteggio;
        }
    }
    $conn->query("UNLOCK TABLES");
    if ($cont > 0)
        return $somma / $cont;
    else
        return 0;
}

function trovaIdInsegnanteDaLezione($id_lezione, $conn): int
{
    $conn->query("LOCK TABLES lezione READ");
    $result = $conn->query("SELECT * FROM lezione WHERE id = '$id_lezione'");
    $lezione = $result->fetch_assoc();
    $id_corso = $lezione['corso_lez'];
    $conn->query("UNLOCK TABLES");
    return trovaIdInsegnanteDaCorso($id_corso, $conn);
}

function trovaIdInsegnanteDaEsercizio($id_ex, $conn): int
{
    $conn->query("LOCK TABLES esercizio READ");
    $result = $conn->query("SELECT * FROM esercizio WHERE id = '$id_ex'");
    $esercizio = $result->fetch_assoc();
    $id_corso = $esercizio['corso_ex'];
    $conn->query("UNLOCK TABLES");
    return trovaIdInsegnanteDaCorso($id_corso, $conn);
}

function trovaIdInsegnanteDaLezioneSuRichiesta($id_lezione, $conn): int
{
    $conn->query("LOCK TABLES richieste_lezioni READ");
    $result = $conn->query("SELECT * FROM richieste_lezioni WHERE id = '$id_lezione'");
    $lezione = $result->fetch_assoc();
    $conn->query("UNLOCK TABLES");
    return $lezione['insegnante'];
}

function trovaMateriaCorso($id_corso, $conn): int
{
    $conn->query("LOCK TABLES corso READ");
    $result = $conn->query("SELECT * FROM corso WHERE id='$id_corso'");
    $corso = $result->fetch_assoc();
    $conn->query("UNLOCK TABLES");
    return $corso['materia'];
}

function trovaCorsoLezione($id_lez, $conn): int
{
    $conn->query("LOCK TABLES lezione READ");
    $result = $conn->query("SELECT * FROM lezione WHERE id='$id_lez'");
    $lez = $result->fetch_assoc();
    $conn->query("UNLOCK TABLES");
    return $lez['corso_lez'];
}

function trovaCorsoEsercizio($id_ex, $conn): int
{
    $conn->query("LOCK TABLES esercizio READ");
    $result = $conn->query("SELECT * FROM esercizio WHERE id='$id_ex'");
    $ex = $result->fetch_assoc();
    $conn->query("UNLOCK TABLES");
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