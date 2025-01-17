<?php
include 'carrello.php';
include '../config/mysql-config.php';
include '../script/funzioni-php.php';
session_start();

$carrello = $_SESSION['carrello'];

$tipo = $_GET['tipo'];

$idCorso;

$id_stud = trovaIdStudente($_SESSION['user'], $conn);
mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES lezione READ, esercizio READ");
$conn->query("BEGIN");
// singola lezione
if ($tipo === 'lez') {
    $id_lez = $_GET['id'];
    $elem = new ElementoC($id_lez, 0, $conn);
    $carrello->aggiungi($elem, $conn);
    $result1 = $conn->query("SELECT * FROM lezione WHERE id='$id_lez'");
    $lez = $result1->fetch_assoc();
    $idCorso = $lez['corso_lez'];
}
// tutte le lezioni
if ($tipo === 'corso') {
    $idCorso = $_GET['id'];
    $id_corso = $_GET['id'];
    $elem = new ElementoC($id_corso, 1, $conn);
    $prez = 0;
    $result2 = $conn->query("SELECT * FROM lezione WHERE corso_lez = '$id_corso'");
    while ($lez = $result2->fetch_assoc()) {
        $id_lez = $lez['id'];
        if (! prodotto_acquistato($id_stud, $id_lez, 0, $conn)) {
            $prez = $prez + $lez['prezzo'];
        }
    }

    $elem->setPrezzo($prez);
    $carrello->aggiungi($elem, $conn);
}
// singolo esercizio
if ($tipo === 'ex') {
    $id_ex = $_GET['id'];
    $elem = new ElementoC($id_ex, 2, $conn);
    $carrello->aggiungi($elem, $conn);
    $result1 = $conn->query("SELECT * FROM esercizio WHERE id='$id_ex'");
    $ex = $result1->fetch_assoc();
    $idCorso = $ex['corso_ex'];
}
// tutti gli esercizi
if ($tipo === 'all_ex') {
    $idCorso = $_GET['id'];
    $id_corso = $_GET['id'];
    $elem = new ElementoC($id_corso, 3, $conn);
    $prez = 0;

    $id_arg = $arg['id'];
    $result2 = $conn->query("SELECT * FROM esercizio WHERE corso_ex = '$id_corso'");
    while ($ex = $result2->fetch_assoc()) {
        $id_ex = $ex['id'];
        if (! prodotto_acquistato($id_stud, $id_ex, 2, $conn)) {
            $prez = $prez + $ex['prezzo'];
        }
    }

    $elem->setPrezzo($prez);

    $carrello->aggiungi($elem, $conn);
}
// tutte le lezioni e tutti gli esercizi
if ($tipo === 'all') {
    $idCorso = $_GET['id'];
    $id_corso = $_GET['id'];
    $elem = new ElementoC($id_corso, 4, $conn);
    $prez = 0;

    $result2 = $conn->query("SELECT * FROM lezione WHERE corso_lez = '$id_corso'");
    while ($lez = $result2->fetch_assoc()) {
        $id_lez = $lez['id'];
        if (! prodotto_acquistato($id_stud, $id_lez, 0, $conn)) {
            $prez = $prez + $lez['prezzo'];
        }
    }
    $result3 = $conn->query("SELECT * FROM esercizio WHERE corso_ex = '$id_corso'");
    while ($ex = $result3->fetch_assoc()) {
        $id_ex = $ex['id'];
        if (! prodotto_acquistato($id_stud, $id_ex, 2, $conn)) {
            $prez = $prez + $ex['prezzo'];
        }
    }

    $elem->setPrezzo($prez);

    $carrello->aggiungi($elem, $conn);
}

// lezione su richiesta
if ($tipo === 'lez_r') {
    $id_lez = $_GET['id'];

    $elem = new ElementoC($id_lez, 5, $conn);

    $carrello->aggiungi($elem, $conn);
}

$conn->query("COMMIT");
$conn->query("UNLOCK TABLES");

if ($tipo === 'lez_r') {
    header("Location: ../visualizza-richiesta-lezione-" . $_GET['ret'] . ".html");
} else {
    header("Location: ../corso-" . $idCorso . ".html");
}
?>