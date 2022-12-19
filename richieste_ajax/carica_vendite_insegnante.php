<?php
include_once '../config/mysql-config.php';
include_once '../script/funzioni-php.php';

$id_insegnante = $_GET['id_ins'];
$result = $conn->query("SELECT * FROM prodotti_ordine PO,ordine O WHERE PO.id_ordine = O.id ORDER BY O.data DESC");
$mese_in_stampa = "";
$totale_mensile = 0;
$numero_righe = $result->num_rows;
$riga_corrente = 0;
$toPrint =  '<table id="pannello_controllo"><tr>
		<td><label>Id</label></td>
		<td><label>Data Ordine</label></td>
		<td><label>Tipo</label></td>
		<td><label>Titolo</label></td>
		<td><label>Prezzo</label></td>
	</tr>';
while ($prodotto = $result->fetch_assoc()) {
    $tipo = $prodotto['tipo'];
    $id = $prodotto['prodotto'];
    $data = stampa_data($prodotto['data']);
    $riga_corrente ++;
    $mese = "";
    switch ($data['mese']) {
        case 1:
            $mese = "Gennaio";
            break;
        case 2:
            $mese = "Febbraio";
            break;
        case 3:
            $mese = "Marzo";
            break;
        case 4:
            $mese = "Aprile";
            break;
        case 5:
            $mese = "Maggio";
            break;
        case 6:
            $mese = "Giugno";
            break;
        case 7:
            $mese = "Luglio";
            break;
        case 8:
            $mese = "Agosto";
            break;
        case 9:
            $mese = "Settembre";
            break;
        case 10:
            $mese = "Ottobre";
            break;
        case 11:
            $mese = "Novembre";
            break;
        case 12:
            $mese = "Dicembre";
            break;
        default:
            break;
    }
    if ($mese_in_stampa != $mese) {
        if ($mese_in_stampa != "") {
            $toPrint = $toPrint . '<tr><td colspan=5><b>Totale mensile:' . $totale_mensile . '&euro;</b></td></tr>';
        }
        $totale_mensile = $prodotto['prezzo'];
        $mese_in_stampa = $mese;
        $toPrint = $toPrint . '<tr><td colspan=5>Mese di&nbsp;' . $mese . '&nbsp;' . $data['anno'] . '</td></tr>';
    } else {
        $totale_mensile = $totale_mensile + $prodotto['prezzo'];
    }

    switch ($tipo) {
        case 0: // lezione
            $result2 = $conn->query("SELECT * FROM lezione L,corso C WHERE L.id = '$id' AND L.corso_lez = C.id");
            $lezione = $result2->fetch_assoc();
            if ($lezione['insegnante'] == $id_insegnante || $id_insegnante == -1) {
                $toPrint = $toPrint . '<tr><td>' . $lezione['id'] . '</td><td>' . $data['giorno'] . '/' . $data['mese'] .
                '/' . $data['anno'] . '</td><td>Lezione Corso</td>' . '<td>' . $lezione['titolo'] . '</td>' . '<td>' . $lezione['prezzo'] . '&euro;</td></tr>';
            }
            break;
        case 2: // esercizio
            $result2 = $conn->query("SELECT * FROM esercizio E, corso C WHERE E.id = '$id' AND E.corso_ex = C.id");
            $esercizio = $result2->fetch_assoc();
            if ($esercizio['insegnante'] == $id_insegnante || $id_insegnante == -1) {
                $toPrint = $toPrint . '<tr><td>' . $esercizio['id'] . '</td><td>' . $data['giorno'] . '/' . $data['mese'] .
                '/' . $data['anno'] . '</td><td>Esercizio Corso</td>' . '<td>' . $esercizio['titolo'] . '</td>' . '<td>' . $esercizio['prezzo'] . '&euro;</td></tr>';
            }
            break;
        case 5: // lezione su richiesta
            $result2 = $conn->query("SELECT * FROM richieste_lezioni WHERE id = '$id'");
            $richiesta = $result2->fetch_assoc();
            if ($richiesta['insegnante'] == $id_insegnante || $id_insegnante == -1) {
                $toPrint = $toPrint . '<tr><td>' . $richiesta['id'] . '</td><td>' . $data['giorno'] . '/' . $data['mese'] .
                '/' . $data['anno'] . '</td><td>Esercizio Corso</td>' . '<td>' . $richiesta['titolo'] . '</td>' . '<td>' . $richiesta['prezzo'] . '&euro;</td></tr>';
            }
            break;
        default:
            break;
    }
    if ($riga_corrente == $numero_righe) {
        $toPrint = $toPrint . '<tr><td colspan=5><b>Totale mensile: ' . $totale_mensile . '&euro;</b></td></tr>';

    }
}
$toPrint = $toPrint . '</table>';
echo $toPrint;
?>