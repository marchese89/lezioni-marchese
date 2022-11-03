<?php
include '../config/mysql-config.php';

$id_corso = $_GET['id'];

$result = $conn->query("SELECT * FROM argomento WHERE corso_arg='$id_corso'");
$toPrint = '<label>Argomento</label><select name="select_argomento" id="select_argomento">';
$toPrint = $toPrint . '<option value="0"></option>';
while($argomento = $result->fetch_assoc()){
    $toPrint = $toPrint . '<option value="'. $argomento['id']. '">' . $argomento['nome']. '</option>';
}

$toPrint = $toPrint . "</select>";

echo $toPrint;

?>