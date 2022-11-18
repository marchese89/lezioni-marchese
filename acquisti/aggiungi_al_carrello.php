<?php 
include 'carrello.php';
include '../config/mysql-config.php';
include '../script/funzioni-php.php';
session_start();

$carrello = $_SESSION['carrello'];

$tipo = $_GET['tipo'];

$idCorso;

$id_stud = trovaIdStudente($_SESSION['user'],$conn);

//singola lezione
if($tipo === 'lez'){
    $id_lez = $_GET['id'];
    $elem = new ElementoC($id_lez, 0,$conn);
    $carrello->aggiungi($elem,$conn);
    $result1 = $conn->query("SELECT * FROM lezione WHERE id='$id_lez'");
    $lez = $result1->fetch_assoc();
    $arg = $lez['arg_lez'];
    $result2 = $conn->query("SELECT * FROM argomento WHERE id='$arg'");
    $argom = $result2->fetch_assoc();
    $idCorso = $argom['corso_arg'];
}
//tutte le lezioni
if($tipo === 'corso'){
    $idCorso = $_GET['id'];
    $id_corso = $_GET['id'];
    $elem = new ElementoC($id_corso, 1,$conn);
    $prez = 0;
    $result1 = $conn->query("SELECT * FROM argomento WHERE corso_arg='$id_corso'");
    while($arg = $result1->fetch_assoc()){
        $id_arg = $arg['id'];
        $result2 = $conn->query("SELECT * FROM lezione WHERE arg_lez='$id_arg'");
        while($lez = $result2->fetch_assoc()){
            $id_lez = $lez['id'];
            if(!prodotto_acquistato($id_stud,$id_lez,0,$conn)){
                $prez = $prez+$lez['prezzo'];
            }
        }
    }
    $elem->setPrezzo($prez);
    $carrello->aggiungi($elem,$conn);
}
//singolo esercizio
if($tipo === 'ex'){
    $id_ex = $_GET['id'];
    $elem = new ElementoC($id_ex, 2,$conn);
    $carrello->aggiungi($elem,$conn);
    $result1 = $conn->query("SELECT * FROM esercizio WHERE id='$id_ex'");
    $lez = $result1->fetch_assoc();
    $arg = $lez['argomento'];
    $result2 = $conn->query("SELECT * FROM argomento WHERE id='$arg'");
    $argom = $result2->fetch_assoc();
    $idCorso = $argom['corso_arg'];
}
//tutti gli esercizi
if($tipo === 'all_ex'){
    $idCorso = $_GET['id'];
    $id_corso = $_GET['id'];
    $elem = new ElementoC($id_corso, 3,$conn);
    $prez = 0;
    $result1 = $conn->query("SELECT * FROM argomento WHERE corso_arg='$id_corso'");
    while($arg = $result1->fetch_assoc()){
        $id_arg = $arg['id'];
        $result2 = $conn->query("SELECT * FROM esercizio WHERE argomento='$id_arg'");
        while($ex = $result2->fetch_assoc()){
            $id_ex = $ex['id'];
            if(!prodotto_acquistato($id_stud,$id_ex,2,$conn)){
                $prez = $prez+$ex['prezzo'];
            }
        }
    }
    $elem->setPrezzo($prez);
    
    $carrello->aggiungi($elem,$conn);
}
//tutti le lezioni e tutti gli esercizi
if($tipo === 'all'){
    $idCorso = $_GET['id'];
    $id_corso = $_GET['id'];
    $elem = new ElementoC($id_corso, 4,$conn);   
    $prez = 0;
    $result1 = $conn->query("SELECT * FROM argomento WHERE corso_arg='$id_corso'");
    while($arg = $result1->fetch_assoc()){
        $id_arg = $arg['id'];
        $result2 = $conn->query("SELECT * FROM lezione WHERE arg_lez='$id_arg'");
        while($lez = $result2->fetch_assoc()){
            $id_lez = $lez['id'];
            if(!prodotto_acquistato($id_stud,$id_lez,0,$conn)){
                $prez = $prez+$lez['prezzo'];
            }
        }
        $result3 = $conn->query("SELECT * FROM esercizio WHERE argomento='$id_arg'");
        while($ex = $result3->fetch_assoc()){
            $id_ex = $ex['id'];
            if(!prodotto_acquistato($id_stud,$id_ex,2,$conn)){
                $prez = $prez+$ex['prezzo'];
            }
        }
    }
    $elem->setPrezzo($prez);
    
    $carrello->aggiungi($elem,$conn);
}


header("Location: ../corso-" . $idCorso . ".html");
?>