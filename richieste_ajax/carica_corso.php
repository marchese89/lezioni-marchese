<?php
include '../config/mysql-config.php';

$id_mat = $_GET['id'];

$result = $conn->query("SELECT * FROM corso WHERE materia='$id_mat'");
$toPrint = '<label>Corso</label><select name="select_corso" id="select_corso" onchange="carica_argomento(this.value)">';
$toPrint = $toPrint . '<option value="0"></option>';
while($corso = $result->fetch_assoc()){
    $toPrint = $toPrint . '<option value="'. $corso['id']. '">' . $corso['nome']. '</option>';
}

$toPrint = $toPrint . "</select>";

echo $toPrint;

?>