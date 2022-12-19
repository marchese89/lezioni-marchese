<?php
include '../config/mysql-config.php';

$id_corso = $_GET['id'];

$conn->query("LOCK TABLES lezione READ");
$conn->query("BEGIN");

$result = $conn->query("SELECT * FROM lezione WHERE corso_lez = '$id_corso' ORDER BY numero ASC");

$toPrint = "<br>";

while ($lez = $result->fetch_assoc()) {
    $toPrint = $toPrint . "<label>";
    $toPrint = $toPrint . "(" . $lez['numero'] . ") - " . $lez['titolo'] . " - prezzo: " . $lez['prezzo'] . "&euro;";
    $toPrint = $toPrint . '</label>   ';
    $toPrint = $toPrint . '<button onclick=location.href="modifica-lezione-' . $lez['id'] . '.html">Modifica</button> ';
    $toPrint = $toPrint . '<button onclick=location.href="insegnanti/elimina_lezione.php?id=' . $lez['id'] . '">Elimina</button><br><br> ';
}

$conn->query("UNLOCK TABLES");

echo $toPrint;
?>