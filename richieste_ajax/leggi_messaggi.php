<?php 
session_start();

include '../config/mysql-config.php';

$id_prod = $_GET['id_prod'];
$tipo_prod =  $_GET['tipo_prod'];
$id_stud = $_GET['id_stud'];

$conn->query("LOCK TABLES chat READ, messaggi_chat READ");
$conn->query("BEGIN");

$result = $conn->query("SELECT * FROM chat WHERE id_prodotto = '$id_prod' AND tipo_prodotto = '$tipo_prod' AND id_studente = '$id_stud'");
$chat = $result->fetch_assoc();
$id_chat = $chat['id'];

$toPrint = '<table border=0 rules=all style="width: 100%" border-radius: 7px 7px 7px 7px;> ';
//carichiamo tutti i messaggi presenti nel database
$result2 = $conn->query("SELECT * FROM messaggi_chat WHERE id_chat = '$id_chat' ORDER BY DATA ASC");
while($messaggio = $result2->fetch_assoc()){
    $autore = $messaggio['autore'];
    $toPrint = $toPrint .'<tr style="height:60px;"><td ';
    if($autore == 0){
        $toPrint = $toPrint .'align="right">';
    }else{
        $toPrint = $toPrint .'align="left">';
    }
    $toPrint = $toPrint . $messaggio['messaggio'] . '</td></tr>';
}
$toPrint = $toPrint . "</table><br>";

$conn->query("UNLOCK TABLES");

echo $toPrint;
?>