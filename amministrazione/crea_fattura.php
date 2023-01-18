<?php
date_default_timezone_set('Europe/Rome');
include_once '../config/mysql-config.php';
require_once '../dompdf/autoload.inc.php';
include_once '../script/funzioni-php.php';

use Dompdf\Dompdf;

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES fattura WRITE, fatture WRITE, amministratore READ");
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
//dati amministratore
$rrr = $conn->query("SELECT * FROM amministratore");
$admin = $rrr->fetch_assoc();

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
<font size=4 >' . $admin['nome'] . ' '. $admin['cognome'] .'</font>
</td>
<td></td>
</tr>
<tr style="height:30px">
<td align="left">
<font size=4 >'. $admin['via'] .', '. $admin['n_civico'] .'</font>
</td>
    
<td></td>
</tr>
<tr style="height:30px">
<td align="left">
<font size=4 >' . $admin['cap']  .' - ' . $admin['citta']. ' (' . $admin['provincia'] .')</font>
</td>
    
<td></td>
</tr>
<tr style="height:30px">
<td align="left">
<font size=4 >PARTITA IVA:&nbsp;' .  $admin['piva'] .'</font>
</td>
    
<td></td>
</tr>
<tr style="height:30px">
<td align="left">
<font size=4 >COD. FISC: ' . $admin['cf'] . '</font>
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
<font size=4 >' . $_POST['nome']. '&nbsp;' . $_POST['cognome'] . '</font>
</td>
</tr>
<tr style="height:30px">
<td></td>
    
<td align="right">
<font size=4 >' . $_POST['via'] . ',' . $_POST['n_civico'] . '</font>
</td>
</tr>
<tr style="height:30px">
<td></td>
    
<td align="right">
<font size=4 >' . $_POST['cap']. ' - ' . $_POST['citta'] . '&nbsp;(' . $_POST['provincia'] . ')</font>
</td>
</tr>
<tr style="height:30px">
<td></td>
    
<td align="right">
<font size=4 >CF:&nbsp;' .  $_POST['cf'] . '</font>
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
</tr>
<tr><td align="center">
            <font size=4 >' . $_POST['descrizione'] .'</font>
            </td>
            <td align="center">
            <font size=4 >' . $_POST['prezzo'] . '&euro;</font>
            </td>
            <td align="center">
            <font size=4 >'. $_POST['qta'] .'</font>
            </td>
            <td align="center">
            <font size=4 ><b>' . $_POST['importo'] . '&euro;</b></font></td>
            </tr>
            </table>
            </td>
            </tr>
            <tr style="height:50px">
<td></td>
    
<td align="right">
<font size=3 >IMPONIBILE:&nbsp; </font>
<font size=3 >'. number_format($_POST['importo']/1.04, 2, '.', '') .'&nbsp;&euro;</font>
</td>
</tr>
<tr style="height:50px">
<td></td>
    
<td align="right">
<font size=3 >Rivalsa Inps 4%:&nbsp;</font>
<font size=3 >' .number_format(($_POST['importo']/1.04)*4/100, 2, '.', '').'&nbsp;&euro;</font>
</td>
</tr>
<tr style="height:50px">
<td></td>
    
<td align="right">
<font size=3 ><b>TOTALE</b>&nbsp;</font>
<font size=3 ><b>' . $_POST['importo'] . '&nbsp;&euro;</b></font>
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
<font size=3 >' . $_POST['note'] . '</font>
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
$percorso = 'fatture/' . $number. '.pdf';
$r13 = $conn->query("INSERT INTO fatture (numero,data,percorso) VALUES('$numeroFattura','$data','$percorso')");
if(!$r13){
    $rollback = TRUE;
}


if($rollback){
    unlink('../fatture/' . $number. '.pdf');
    $conn->query("ROLLBACK");
}else{
    $r = $conn->query("COMMIT");
}

$conn->query("UNLOCK TABLES");


header('Location: ../home-insegnante.html');

?>
