<?php
include '../config/mysql-config.php';
include '../script/funzioni-php.php';
session_start();
$id_mat = $_GET['id'];



$result = $conn->query("SELECT * FROM corso WHERE materia='$id_mat'");
$toPrint = '<label>Corso - Insegnante   </label><select name="select_corso" id="select_corso">';
$toPrint = $toPrint . '<option value="0"></option>';
while($corso = $result->fetch_assoc()){
    $id_ins = $corso['insegnante'];
    $res = $conn->query("SELECT * FROM insegnante WHERE id = '$id_ins'");
    $ins = $res->fetch_assoc();
    $id_ut = $ins['utente_i'];
    $res2 = $conn->query("SELECT * FROM utente WHERE id = '$id_ut'");
    $utente = $res2->fetch_assoc();
    $toPrint = $toPrint . '<option value="'. $corso['id']. '">' . $corso['nome']. ' - '. $utente['nome']. ' ' . $utente['cognome'].'</option>';
}

$toPrint = $toPrint . "</select>";

echo $toPrint;

?>