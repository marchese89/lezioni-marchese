<?php
include '../config/mysql-config.php';

$id_arg = $_GET['id'];

$result0 = $conn->query("SELECT * FROM argomento WHERE id='$id_arg'");
$arg = $result0->fetch_assoc();
$id_corso = $arg['corso_arg'];
// ORDER BY numero ASC
$result = $conn->query("SELECT * FROM argomento WHERE corso_arg='$id_corso'");

$toPrint = "<br>";

while ($argomento = $result->fetch_assoc()) {
    $id_argomento = $argomento['id'];
    $result2 = $conn->query("SELECT * FROM lezione WHERE arg_lez='$id_argomento' ORDER BY numero ASC");
    while ($lez = $result2->fetch_assoc()) {
        $toPrint = $toPrint . "<label>";
        $toPrint = $toPrint . "(" . $lez['numero'] . ") - " . $argomento['nome'] ." - ". $lez['titolo'] . " - prezzo: " . $lez['prezzo'] . "&euro;";
        $toPrint = $toPrint . '</label>   ';
        $toPrint = $toPrint . '<button onclick=location.href="modifica-lezione-' . $lez['id'] . '.html">Modifica</button> ';
        $toPrint = $toPrint . '<button onclick=location.href="insegnanti/elimina_lezione.php?id=' . $lez['id'] . '">Elimina</button><br><br> ';
    }
}
echo $toPrint;
?>