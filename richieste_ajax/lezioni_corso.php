<?php 
include '../config/mysql-config.php';

$id_corso = $_GET['id'];

$result = $conn->query("SELECT * FROM lezione WHERE corso='$id_corso' ORDER BY numero ASC");

$toPrint = "<label>";

while($row = $result->fetch_assoc()){
    $toPrint = $toPrint . "(" . $row['numero'] . ") - " . $row['titolo'] . " - prezzo: ". $row['prezzo']. "&euro;";
}
$toPrint = $toPrint . "</label>";
echo $toPrint;
?>