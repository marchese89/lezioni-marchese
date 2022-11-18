<?php 
date_default_timezone_set('Europe/Rome');
include_once 'carrello.php';
include_once '../script/funzioni-php.php';
include '../config/mysql-config.php';
session_start();


$data = date("Y-m-d H:i:s");
//recuperiamo le informazioni relative al cliente
$email = $_SESSION['user'];
$result1 = $conn->query("SELECT * FROM utente WHERE email='$email'");
$ut = $result1->fetch_assoc();
$id_ut = $ut['id'];
$result2 = $conn->query("SELECT * FROM studente WHERE utente_s='$id_ut'");
$stud = $result2->fetch_assoc();
$id_stud = $stud['id'];

//inseriamo l'ordine
$result3 = $conn->query("INSERT INTO ordine(cliente,data) VALUES ('$id_stud','$data')");

$result4 = $conn->query("SELECT * FROM ordine WHERE cliente='$id_stud' AND data='$data'");
$ordine = $result4->fetch_assoc();
$id_ordine = $ordine['id'];

$contenuto = $_SESSION['carrello']->contenuto();

for ($i = 0; $i < count($contenuto); $i++) {
    $elem = $contenuto[$i];
    $tipo = $elem->getTipoElemento();
    $id = $elem->getId();
    switch ($tipo){
        case 0://lezione
            
            $result1 = $conn->query("INSERT INTO prodotti_ordine(id_ordine,prodotto,tipo) VALUES ('$id_ordine','$id','0')");   
       
        case 1://tutte le lezioni di un corso
            
            $result1 = $conn->query("SELECT * FROM argomento WHERE corso_arg='$id'");
            while($arg = $result1->fetch_assoc()){
                $id_arg = $arg['id'];
                $result2 = $conn->query("SELECT * FROM lezione WHERE arg_lez='$id_arg'");
                while($lez = $result2->fetch_assoc()){
                    $id_lez = $lez['id'];
                    if(!prodotto_acquistato($id_stud, $id_lez, 0, $conn)){
                        $conn->query("INSERT into prodotti_ordine(id_ordine,prodotto,tipo) VALUES ('$id_ordine','$id_lez','0')");
                    }
                }
            }
                     
            break;
        case 2://esercizio
            $result1 = $conn->query("INSERT INTO prodotti_ordine(id_ordine,prodotto,tipo) VALUES ('$id_ordine','$id','2')");
         
            break;
        case 3://tutti gli esercizi di un corso
            
            $result1 = $conn->query("SELECT * FROM argomento WHERE corso_arg='$id'");
            while($arg = $result1->fetch_assoc()){
                $id_arg = $arg['id'];
                $result2 = $conn->query("SELECT * FROM esercizio WHERE argomento='$id_arg'");
                while($ex = $result2->fetch_assoc()){
                    $id_ex = $ex['id'];
                    if(!prodotto_acquistato($id_stud, $id_ex, 2, $conn)){
                        $conn->query("INSERT INTO prodotti_ordine(id_ordine,prodotto,tipo) VALUES ('$id_ordine','$id_ex','2')");
                    }
                }
            }
            
            break;
        case 4://tutte le lezioni e tutti gli esercizi di un corso
            echo 'Tutte le lezioni e tutti gli esercizi di un corso<br>';
            $result5 = $conn->query("SELECT * FROM argomento WHERE corso_arg='$id'");
            
            while($arg = $result5->fetch_assoc()){
                $id_arg = $arg['id'];
                $result2 = $conn->query("SELECT * FROM lezione WHERE arg_lez='$id_arg'");
                while($lez = $result2->fetch_assoc()){
                    $id_lez = $lez['id'];
                    if(!prodotto_acquistato($id_stud, $id_lez, 0, $conn)){
                        $conn->query("INSERT INTO prodotti_ordine(id_ordine,prodotto,tipo) VALUES ('$id_ordine','$id_lez','0')");   
                    }
                }
                $result3 = $conn->query("SELECT * FROM esercizio WHERE argomento='$id_arg'");
                while($ex = $result3->fetch_assoc()){
                    $id_ex = $ex['id'];
                    if(!prodotto_acquistato($id_stud, $id_ex, 2, $conn)){
                        $conn->query("INSERT INTO prodotti_ordine(id_ordine,prodotto,tipo) VALUES ('$id_ordine','$id_ex','2')");
                    }
                }
            }
            break;
        default:
            break;
        
    }
}

$_SESSION['carrello']->vuotaCarrello();

header('Location: ../ordine-effettuato.html')
?>