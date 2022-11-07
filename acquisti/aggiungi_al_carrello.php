<?php 
include 'carrello.php';
include '../config/mysql-config.php';
session_start();

$carrello = $_SESSION['carrello'];

$tipo = $_GET['tipo'];

$idCorso;

//singola lezione
if($tipo === 'lez'){
    $id_lez = $_GET['id'];
    $elem = new ElementoC($id_lez, 0);
    $carrello->aggiungi($elem);
    $result1 = $conn->query("SELECT * FROM lezione WHERE id='$id_lez'");
    $lez = $result1->fetch_assoc();
    $arg = $lez['arg_lez'];
    $result2 = $conn->query("SELECT * FROM argomento WHERE id='$arg'");
    $argom = $result2->fetch_assoc();
    $idCorso = $argom['corso_arg'];
}
//tutte le lezioni
if($tipo === 'corso'){
    $idCorso = $_GET['id'];
    $id_corso = $_GET['id'];
    $elem = new ElementoC($id_corso, 1);
    $carrello->aggiungi($elem);
}
//singolo esercizio
if($tipo === 'ex'){
    $id_ex = $_GET['id'];
    $elem = new ElementoC($id_ex, 2);
    $carrello->aggiungi($elem);
    $result1 = $conn->query("SELECT * FROM esercizio WHERE id='$id_ex'");
    $lez = $result1->fetch_assoc();
    $arg = $lez['argomento'];
    $result2 = $conn->query("SELECT * FROM argomento WHERE id='$arg'");
    $argom = $result2->fetch_assoc();
    $idCorso = $argom['corso_arg'];
}
//tutti gli esercizi
if($tipo === 'all_ex'){
    $idCorso = $_GET['id'];
    $id_corso = $_GET['id'];
    $elem = new ElementoC($id_corso, 3);
    $carrello->aggiungi($elem);
}
//tutti le lezioni e tutti gli esercizi
if($tipo === 'all'){
    $idCorso = $_GET['id'];
    $id_corso = $_GET['id'];
    $elem = new ElementoC($id_corso, 4);
    $carrello->aggiungi($elem);
}


header("Location: ../corso-" . $idCorso . ".html");
?>