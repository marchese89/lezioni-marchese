<?php
include '../config/mysql-config.php';
include '../script/funzioni-php.php';
session_start();
$id_mat = $_GET['id'];


$id_ins = trovaIdInsegnante($_SESSION['user'],$conn);

$result = $conn->query("SELECT * FROM corso WHERE materia='$id_mat' AND insegnante = '$id_ins'");
$toPrint = '<label>Corso</label><select name="select_corso" id="select_corso">';
$toPrint = $toPrint . '<option value="0"></option>';
while($corso = $result->fetch_assoc()){
    $toPrint = $toPrint . '<option value="'. $corso['id']. '">' . $corso['nome']. '</option>';
}

$toPrint = $toPrint . "</select>";

echo $toPrint;

?>