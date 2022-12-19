<?php 
include_once '../config/mysql-config.php';
$stud = $_GET['stud'];
$prod = $_GET['prod'];
$tipo_prod = $_GET['tipo_prod'];
$punt = $_GET['punt'];

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES feedback WRITE");
$conn->query("BEGIN");

$r = $conn->query("SELECT * FROM feedback WHERE studente = '$stud' AND prodotto = '$prod' AND tipo_prodotto = '$tipo_prod'");
if($r->num_rows > 0){
    $r = $conn->query("UPDATE feedback SET punteggio = '$punt' WHERE studente = '$stud' AND prodotto = '$prod' AND tipo_prodotto = '$tipo_prod'");
    if($r){
        $conn->query("COMMIT");
    }else {
        $conn->query("ROLLBACK");
    }
}else{
    $r = $conn->query("INSERT feedback (studente,prodotto,tipo_prodotto,punteggio) VALUES ('$stud', '$prod', '$tipo_prod', '$punt')");
    
    if($r){
        $conn->query("COMMIT");
    }else {
        $conn->query("ROLLBACK");
    }
}

$conn->query("UNLOCK TABLES");

$toPrint = '<a ';
if($punt > 0){
    $toPrint = $toPrint . 'style="opacity: 100%;"';
}
$toPrint = $toPrint . 'onclick="invia_feefback('. $stud . ','. $prod. ','. $tipo_prod .',1)">⭐</a>';

$toPrint = $toPrint .'<a ';
if($punt > 1){
    $toPrint = $toPrint . 'style="opacity: 100%;"';
}
$toPrint = $toPrint . 'onclick="invia_feefback('. $stud . ','. $prod. ','. $tipo_prod .',2)">⭐</a>';
$toPrint = $toPrint .'<a ';
if($punt > 2){
    $toPrint = $toPrint . 'style="opacity: 100%;"';
}
$toPrint = $toPrint . 'onclick="invia_feefback('. $stud . ','. $prod. ','. $tipo_prod .',3)">⭐</a>';
$toPrint = $toPrint .'<a ';
if($punt > 3){
    $toPrint = $toPrint . 'style="opacity: 100%;"';
}
$toPrint = $toPrint . 'onclick="invia_feefback('. $stud . ','. $prod. ','. $tipo_prod .',4)">⭐</a>';
$toPrint = $toPrint .'<a ';
if($punt > 4){
    $toPrint = $toPrint . 'style="opacity: 100%;"';
}
$toPrint = $toPrint . 'onclick="invia_feefback('. $stud . ','. $prod. ','. $tipo_prod .',5)">⭐</a>';

echo $toPrint;
?>


