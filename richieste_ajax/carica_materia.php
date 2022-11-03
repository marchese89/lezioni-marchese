<?php
include '../config/mysql-config.php';

$id_a_t = $_GET['id'];

$result = $conn->query("SELECT * FROM materia WHERE area_tematica='$id_a_t'");
$toPrint = '<label>Materia</label><select name="select_materia" id="select_materia" onchange="carica_corso(this.value)">';
$toPrint = $toPrint . '<option value="0"></option>';
while($materia = $result->fetch_assoc()){
    $toPrint = $toPrint . '<option value="'. $materia['id']. '">' . $materia['nome']. '</option>';
}

$toPrint = $toPrint . "</select>";

echo $toPrint;

?>