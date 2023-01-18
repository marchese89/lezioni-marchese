<?php
date_default_timezone_set('Europe/Rome');
include_once 'carrello.php';
include_once '../script/funzioni-php.php';
include_once '../config/mysql-config.php';
require_once '../dompdf/autoload.inc.php';
require_once '../pagamenti/stripe-php-9.6.0/init.php';

use Dompdf\Dompdf;
session_start();

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES fattura WRITE, fatture WRITE, utente READ,studente READ,lezione READ,esercizio READ,richieste_lezioni WRITE,ordine WRITE,prodotti_ordine WRITE,chat WRITE");
$conn->query("BEGIN");
$rollback = FALSE;
$dompdf = new Dompdf();
$data = date("Y-m-d H:i:s");
$data_ = stampa_data($data);
$dataFattura = $data_['giorno'].'/'. $data_['mese']. '/' . $data_['anno'];
$rr = $conn->query("SELECT * FROM fattura");
$u_f = $rr->fetch_assoc();
$ultimo = $u_f['numero'];

$data_ultima_f = $u_f['data'];
$data2 = stampa_data($data_ultima_f);
$numeroFattura  = 1;
if($data_['anno'] == $data2['anno']){
$numeroFattura = $ultimo+1;
}

$r0 = $conn->query("DELETE FROM fattura WHERE numero = '$ultimo'");
if(!$r0){
    $rollback = TRUE;
}
$r = $conn->query("INSERT INTO fattura (numero,data) VALUES('$numeroFattura','$data')");
if(!$r){
    $rollback = TRUE;
}
// recuperiamo le informazioni relative al cliente

$id_stud = trovaIdStudente($_SESSION['user'], $conn);
$r0 = $conn->query("SELECT * FROM studente WHERE id = '$id_stud'");
if(!$r0){
    $rollback = TRUE;
}
$studente = $r0->fetch_assoc();
$id_utente = $studente['utente_s'];
$r1 = $conn->query("SELECT * FROM utente WHERE id = '$id_utente'");
if(!$r1){
    $rollback = TRUE;
}
$utente = $r1->fetch_assoc();
$html = '
<table width="100%" cellspacing="0" cellpadding="0"
		align="center"
		style="border-collapse: collapse;"
		RULES=none FRAME=none border="0">
<tr style="height:100px">
<td align="center" colspan="3">
<h1>Fattura</h1>
</td>
</tr>
<tr style="height:30px">
<td align="left">
<font size=4 >Antonio Giovanni Marchese</font>
</td>
<td></td>
</tr>
<tr style="height:30px">
<td align="left">
<font size=4 >Via Teodoro Mesimerio, 1/A</font>
</td>
    
<td></td>
</tr>
<tr style="height:30px">
<td align="left">
<font size=4 >89822 -  Spadola (VV)</font>
</td>
    
<td></td>
</tr>
<tr style="height:30px">
<td align="left">
<font size=4 >PARTITA IVA:&nbsp;03810660799</font>
</td>
    
<td></td>
</tr>
<tr style="height:30px">
<td align="left">
<font size=4 >COD. FISC: MRCNNG89L11I872V</font>
</td>
    
<td></td>
</tr>
<tr style="height:30px">
<td></td>
    
<td align="right">
<h2>Cliente</h2>
</td>
</tr>
<tr style="height:30px">
<td></td>
    
<td align="right">
<font size=4 >' . $utente['nome']. '&nbsp;' . $utente['cognome'] . '</font>
</td>
</tr>
<tr style="height:30px">
<td></td>
    
<td align="right">
<font size=4 >' . $studente['via'] . ',' . $studente['n_civico'] . '</font>
</td>
</tr>
<tr style="height:30px">
<td></td>
    
<td align="right">
<font size=4 >' . $studente['cap']. ' - ' . $studente['citta'] . '&nbsp;(' . $studente['provincia'] . ')</font>
</td>
</tr>
<tr style="height:30px">
<td></td>
    
<td align="right">
<font size=4 >CF:&nbsp;' .  $studente['cf'] . '</font>
</td>
</tr>
<tr style="height:30px">
<td align="left">
<font size=4 ><b>DATA: </b></font>' .
$dataFattura
. '</td>
    
<td></td>
</tr>
<tr style="height:100px">
<td align="left" style="vertical-align:top">
<font size=4 ><b>FATTURA: </b></font>'.
$numeroFattura .'</td>
    
<td></td>
</tr>
<tr>
    
    
<td align="left" colspan="2">
<table  rules="all" border="1" align="right" style="width:100%" >
<tr style="height:50px">
    
<td align="center">
<font size=4 ><b>&nbsp;DESCRIZIONE&nbsp;</b></font>
</td>
<td align="center">
<font size=4 ><b>&nbsp;PREZZO&nbsp;</b></font>
</td>
<td align="center">
<font size=4 ><b>&nbsp;QTA&nbsp;</b></font>
</td>
<td align="center">
<font size=4 ><b>&nbsp;IMPORTO&nbsp;</b></font>
</td>
</tr>';



// inseriamo l'ordine
$result3 = $conn->query("INSERT INTO ordine(cliente,data) VALUES ('$id_stud','$data')");
if(!$result3){
    $rollback = TRUE;
}
$result4 = $conn->query("SELECT * FROM ordine WHERE cliente='$id_stud' AND data='$data'");
if(!$result4){
    $rollback = TRUE;
}
$ordine = $result4->fetch_assoc();
$id_ordine = $ordine['id'];

$contenuto = $_SESSION['carrello']->contenuto();
$prezzo_totale = 0;
for ($i = 0; $i < count($contenuto); $i ++) {
    $elem = $contenuto[$i];
    $tipo = $elem->getTipoElemento();
    $id = $elem->getId();
    switch ($tipo) {
        case 0: // lezione
            $result = $conn->query("SELECT * FROM lezione WHERE id = '$id'");
            if(!$result){
                $rollback = TRUE;
            }
            $lezione = $result->fetch_assoc();
            $prezzo = $lezione['prezzo'];
            $r4 = $conn->query("INSERT INTO prodotti_ordine(id_ordine,prodotto,tipo,prezzo) VALUES ('$id_ordine','$id','0','$prezzo')");
            if(!$r4){
                $rollback = TRUE;
            }
            $r4 = $conn->query("INSERT INTO chat(id_prodotto,tipo_prodotto,id_studente) VALUES ('$id','0','$id_stud')");
            if(!$r4){
                $rollback = TRUE;
            }
            $html = $html . '<tr><td align="center">
            <font size=4 >Lezione:&nbsp;' . $lezione['titolo'] .'</font>
            </td>
            <td align="center">
            <font size=4 >' . $lezione['prezzo'] . '&euro;</font>
            </td>
            <td align="center">
            <font size=4 >1</font>
            </td>
            <td align="center">
            <font size=4 ><b>' . $lezione['prezzo'] . '&euro;</b></font></td>
            </tr>';
            $prezzo_totale = $prezzo_totale + $lezione['prezzo'];
            break;
        case 1: // tutte le lezioni di un corso
            $result2 = $conn->query("SELECT * FROM lezione WHERE corso_lez='$id'");
            if(!$result2){
                $rollback = TRUE;
            }
            while ($lez = $result2->fetch_assoc()) {
                $id_lez = $lez['id'];
                $prezzo = $lez['prezzo'];
                if (! prodotto_acquistato($id_stud, $id_lez, 0, $conn)) {
                    $r5 = $conn->query("INSERT into prodotti_ordine(id_ordine,prodotto,tipo,prezzo) VALUES ('$id_ordine','$id_lez','0','$prezzo')");
                    if(!$r5){
                        $rollback = TRUE;
                    }
                    $r5 = $conn->query("INSERT INTO chat(id_prodotto,tipo_prodotto,id_studente) VALUES ('$id_lez','0','$id_stud')");
                    if(!$r5){
                        $rollback = TRUE;
                    }
                    $html = $html . '<tr><td align="center">
            <font size=4 >Lezione:&nbsp;' . $lez['titolo'] .'</font>
            </td>
            <td align="center">
            <font size=4 >' . $lez['prezzo'] . '&euro;</font>
            </td>
            <td align="center">
            <font size=4 >1</font>
            </td>
            <td align="center">
            <font size=4 ><b>' . $lez['prezzo'] . '&euro;</b></font></td>
            </tr>';
                    $prezzo_totale = $prezzo_totale + $lez['prezzo'];
                }
                
            }
            
            break;
        case 2: // esercizio
            $result = $conn->query("SELECT * FROM esercizio WHERE id = '$id'");
            $esercizio = $result->fetch_assoc();
            $prezzo = $esercizio['prezzo'];
            $r6 = $conn->query("INSERT INTO prodotti_ordine(id_ordine,prodotto,tipo,prezzo) VALUES ('$id_ordine','$id','2','$prezzo')");
            if(!$r6){
                $rollback = TRUE;
            }
            $r6 = $conn->query("INSERT INTO chat(id_prodotto,tipo_prodotto,id_studente) VALUES ('$id','2','$id_stud')");
            if(!$r6){
                $rollback = TRUE;
            }
            $html = $html . '<tr><td align="center">
            <font size=4 >Esercizio:&nbsp;' . $esercizio['titolo'] .'</font>
            </td>
            <td align="center">
            <font size=4 >' . $esercizio['prezzo'] . '&euro;</font>
            </td>
            <td align="center">
            <font size=4 >1</font>
            </td>
            <td align="center">
            <font size=4 ><b>' . $esercizio['prezzo'] . '&euro;</b></font></td>
            </tr>';
            $prezzo_totale = $prezzo_totale + $esercizio['prezzo'];
            break;
        case 3: // tutti gli esercizi di un corso
            $result2 = $conn->query("SELECT * FROM esercizio WHERE corso_ex='$id'");
            while ($ex = $result2->fetch_assoc()) {
                $id_ex = $ex['id'];
                $prezzo = $ex['prezzo'];
                if (! prodotto_acquistato($id_stud, $id_ex, 2, $conn)) {
                    $r7 = $conn->query("INSERT INTO prodotti_ordine(id_ordine,prodotto,tipo,prezzo) VALUES ('$id_ordine','$id_ex','2','$prezzo')");
                    if(!$r7){
                        $rollback = TRUE;
                    }
                    $r7 = $conn->query("INSERT INTO chat(id_prodotto,tipo_prodotto,id_studente) VALUES ('$id_ex','2','$id_stud')");
                    if(!$r7){
                        $rollback = TRUE;
                    }
                    $html = $html . '<tr><td align="center">
            <font size=4 >Esercizio:&nbsp;' . $ex['titolo'] .'</font>
            </td>
            <td align="center">
            <font size=4 >' . $ex['prezzo'] . '&euro;</font>
            </td>
            <td align="center">
            <font size=4 >1</font>
            </td>
            <td align="center">
            <font size=4 ><b>' . $ex['prezzo'] . '&euro;</b></font></td>
            </tr>';
                    $prezzo_totale = $prezzo_totale + $ex['prezzo'];
                }
            }
            
            break;
        case 4: // tutte le lezioni e tutti gli esercizi di un corso
            $result2 = $conn->query("SELECT * FROM lezione WHERE corso_lez = '$id'");
            while ($lez = $result2->fetch_assoc()) {
                $id_lez = $lez['id'];
                $prezzo = $lez['prezzo'];
                if (! prodotto_acquistato($id_stud, $id_lez, 0, $conn)) {
                    $r8 = $conn->query("INSERT INTO prodotti_ordine(id_ordine,prodotto,tipo,prezzo) VALUES ('$id_ordine','$id_lez','0','$prezzo')");
                    if(!$r8){
                        $rollback = TRUE;
                    }
                    $r8 = $conn->query("INSERT INTO chat(id_prodotto,tipo_prodotto,id_studente) VALUES ('$id_lez','0','$id_stud')");
                    if(!$r8){
                        $rollback = TRUE;
                    }
                    $html = $html . '<tr><td align="center">
            <font size=4 >Lezione:&nbsp;' . $lez['titolo'] .'</font>
            </td>
            <td align="center">
            <font size=4 >' . $lez['prezzo'] . '&euro;</font>
            </td>
            <td align="center">
            <font size=4 >1</font>
            </td>
            <td align="center">
            <font size=4 ><b>' . $lez['prezzo'] . '&euro;</b></font></td>
            </tr>';
                    $prezzo_totale = $prezzo_totale + $lez['prezzo'];
                }
            }
            $result3 = $conn->query("SELECT * FROM esercizio WHERE corso_ex = '$id'");
            while ($ex = $result3->fetch_assoc()) {
                $id_ex = $ex['id'];
                $prezzo = $ex['prezzo'];
                if (! prodotto_acquistato($id_stud, $id_ex, 2, $conn)) {
                    $r9 = $conn->query("INSERT INTO prodotti_ordine(id_ordine,prodotto,tipo,prezzo) VALUES ('$id_ordine','$id_ex','2','$prezzo')");
                    if(!$r9){
                        $rollback = TRUE;
                    }
                    $r9 = $conn->query("INSERT INTO chat(id_prodotto,tipo_prodotto,id_studente) VALUES ('$id_ex','2','$id_stud')");
                    if(!$r9){
                        $rollback = TRUE;
                    }
                    $html = $html . '<tr><td align="center">
            <font size=4 >Esercizio:&nbsp;' . $ex['titolo'] .'</font>
            </td>
            <td align="center">
            <font size=4 >' . $ex['prezzo'] . '&euro;</font>
            </td>
            <td align="center">
            <font size=4 >1</font>
            </td>
            <td align="center">
            <font size=4 ><b>' . $ex['prezzo'] . '&euro;</b></font></td>
            </tr>';
                    $prezzo_totale = $prezzo_totale + $ex['prezzo'];
                }
            }

            break;
        case 5:
            $r10 = $conn->query("UPDATE richieste_lezioni SET evasa = '1' WHERE id = '$id'");
            if(!$r10){
                $rollback = TRUE;
            }
            $res = $conn->query("SELECT * FROM richieste_lezioni WHERE id = '$id'");
            if(!$res){
                $rollback = TRUE;
            }
            $richiesta = $res->fetch_assoc();
            $prezzo = $richiesta['prezzo'];
            $html = $html . '<tr><td align="center">
            <font size=4 >Lezione/Esercizio su richiesta:&nbsp;' . $richiesta['titolo'] .'</font>
            </td>
            <td align="center">
            <font size=4 >' . $prezzo . '&euro;</font>
            </td>
            <td align="center">
            <font size=4 >1</font>
            </td>
            <td align="center">
            <font size=4 ><b>' . $prezzo . '&euro;</b></font></td>
            </tr>';
            $r11 = $conn->query("INSERT INTO prodotti_ordine(id_ordine,prodotto,tipo,prezzo) VALUES ('$id_ordine','$id','5','$prezzo')");
            if(!$r11){
                $rollback = TRUE;
            }
            $r11 = $conn->query("INSERT INTO chat(id_prodotto,tipo_prodotto,id_studente) VALUES ('$id','5','$id_stud')");
            if(!$r11){
                $rollback = TRUE;
            }
            $prezzo_totale = $prezzo_totale + $richiesta['prezzo'];
            break;
        default:
            break;
    }
}
 $html = $html .'
            </table>
            </td>
            </tr>
            <tr style="height:50px">
<td></td>
                
<td align="right">
<font size=3 >IMPONIBILE:&nbsp; </font>
<font size=3 >'. number_format($prezzo_totale/1.04, 2, '.', '') .'&nbsp;&euro;</font>
</td>
</tr>
<tr style="height:50px">
<td></td>
                
<td align="right">
<font size=3 >Rivalsa Inps 4%:&nbsp;</font>
<font size=3 >' .number_format(($prezzo_totale/1.04)*4/100, 2, '.', '').'&nbsp;&euro;</font>
</td>
</tr>
<tr style="height:50px">
<td></td>
                
<td align="right">
<font size=3 ><b>TOTALE</b>&nbsp;</font>
<font size=3 ><b>' . $prezzo_totale . '&nbsp;&euro;</b></font>
</td>
</tr>
<tr>
<td>
<font size=3 >Imposta di bollo &euro; 2,00 su originale</font>
</td>
<td>
</td>
</tr>
<tr>
<td>
<font size=3 >su Importi superiori ad &euro; 77,47</font>
</td>
<td>
</td>
</tr>
<tr>
<td>
<font size=3 ><b>NOTE</b></font>
</td>
<td>
</td>
</tr>
<tr>
<td>
<font size=3 >Pagamento online tramite Carta di Credito</font>
</td>
<td>
</td>
</tr>
<tr align="center" style="height:200px" >
<td colspan="2">
<font size=3 >&nbsp;</font>
</td>
</tr>
<tr align="center">
<td colspan="2">
<font size=3 ><b>Operazione in franchigia da Iva art. 1 cc. 54-89 L. 190/2014 –</b></font>
</td>
</tr>
<tr align="center">
<td colspan="2">
<font size=3 ><b>Non soggetta a ritenuta d’acconto ai sensi del c. 67 L. 190/2014</b></font>
</td>
</tr>
</table>
';

 $number = 1;
 while (file_exists('../fatture/' . $number . '.pdf')) {
     $number ++;
 }

 $dompdf->loadHtml($html);
 $dompdf->setPaper('A4', 'portait');
 $dompdf->render();

 $pdf = $dompdf->output();
 file_put_contents('../fatture/' . $number. '.pdf', $pdf);
 $percorso_fattura = 'fatture/' . $number. '.pdf';
 $r12 = $conn->query("UPDATE ordine SET fattura = '$percorso_fattura' WHERE id = '$id_ordine'");
 if(!$r12){
     $rollback = TRUE;
 }
 $r13 = $conn->query("INSERT INTO fatture (numero,data,percorso) VALUES('$numeroFattura','$data','$percorso_fattura')");
 if(!$r13){
     $rollback = TRUE;
 }
 if($rollback){
     unlink('../fatture/' . $number. '.pdf');
     $conn->query("ROLLBACK");
     $conn->query("UNLOCK TABLES");
     //rimborso totale
     $stripe = new \Stripe\StripeClient('sk_test_51LkNn9H3pdyIax9sV9wedmHBJPMfcfTdeXDXbMhnBTlN3dzYa7kTVrSl3CJPYHNgRklQiJJI5rrjOMjoOM4RbALu00n77YaBXr');
     $stripe->refunds->create(['payment_intent' => $_GET['payment_intent']]);
     header('Location: ../ordine-fallito.html');
 }else{
     $r = $conn->query("COMMIT");
     $conn->query("UNLOCK TABLES");
     if(!$r){
         unlink('../fatture/' . $number. '.pdf');
         $conn->query("ROLLBACK");
         $conn->query("UNLOCK TABLES");
         //rimborso totale
         $stripe = new \Stripe\StripeClient('sk_test_51LkNn9H3pdyIax9sV9wedmHBJPMfcfTdeXDXbMhnBTlN3dzYa7kTVrSl3CJPYHNgRklQiJJI5rrjOMjoOM4RbALu00n77YaBXr');
         $stripe->refunds->create(['payment_intent' => $_GET['payment_intent']]);
         header('Location: ../ordine-fallito.html');
     }
     $_SESSION['carrello']->vuotaCarrello();
     header('Location: ../ordine-effettuato.html');
 }
 

 ?>