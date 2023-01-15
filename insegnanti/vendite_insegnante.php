<table id="pannello_controllo">
	<tr id="titolo">
		<th align="center" colspan=5>Vendite</th>
	</tr>

	<tr style="height: 60px">
		<td><label>Id</label></td>
		<td><label>Data Ordine</label></td>
		<td><label>Tipo</label></td>
		<td><label>Titolo</label></td>
		<td><label>Prezzo</label></td>
	</tr>
	<?php

$result = $conn->query("SELECT * FROM prodotti_ordine PO,ordine O WHERE PO.id_ordine = O.id ORDER BY O.data DESC");
$mese_in_stampa = "";
$totale_mensile = 0;
$numero_righe = $result->num_rows;
$riga_corrente = 0;
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

    switch ($tipo) {
        case 0: // lezione
            $result2 = $conn->query("SELECT * FROM lezione L,corso C WHERE L.id = '$id' AND L.corso_lez = C.id");
            $lezione = $result2->fetch_assoc();
            
                if ($mese_in_stampa != $mese) {
                    if ($mese_in_stampa != "") {
                        ?>
            <tr>
		<td colspan=5><b>Totale mensile: <?php echo $totale_mensile;?>&nbsp;&euro;</b></td>
	</tr>
        <?php
                    }
                    $totale_mensile = $prodotto['prezzo'];
                    $mese_in_stampa = $mese;
                    ?>
        <tr>
		<td colspan=5>Mese di&nbsp; <?php echo $mese;?>&nbsp; <?php echo $data['anno'];?></td>
	</tr>
    <?php
                } else {
                    $totale_mensile = $totale_mensile + $prodotto['prezzo'];
                }
                ?>
	               <tr style="height: 60px">
		<td><?php echo $lezione['id'];?></td>
		<td><?php echo $data['giorno'] . "/" . $data['mese'] . "/". $data['anno']; ?></td>
		<td>Lezione Corso</td>
		<td><?php echo $lezione['titolo'];?></td>
		<td><?php echo $lezione['prezzo'];?>&euro;</td>

	</tr>
	               <?php
            
            break;
        case 2: // esercizio
            $result2 = $conn->query("SELECT * FROM esercizio E, corso C WHERE E.id = '$id' AND E.corso_ex = C.id");
            $esercizio = $result2->fetch_assoc();
                if ($mese_in_stampa != $mese) {
                    if ($mese_in_stampa != "") {
                        ?>
            <tr>
		<td colspan=5><b>Totale mensile: <?php echo $totale_mensile;?>&nbsp;&euro;</b></td>
	</tr>
        <?php
                    }
                    $totale_mensile = $prodotto['prezzo'];
                    $mese_in_stampa = $mese;
                    ?>
        <tr>
		<td colspan=5>Mese di&nbsp; <?php echo $mese;?>&nbsp; <?php echo $data['anno'];?></td>
	</tr>
    <?php
                } else {
                    $totale_mensile = $totale_mensile + $prodotto['prezzo'];
                }
                ?>
	               <tr style="height: 60px">
		<td><?php echo $esercizio['id'];?></td>
		<td><?php echo $data['giorno'] . "/" . $data['mese'] . "/". $data['anno']; ?></td>
		<td>Esercizio Corso</td>
		<td><?php echo $esercizio['titolo'];?></td>
		<td><?php echo $esercizio['prezzo'];?>&euro;</td>

	</tr>
	               <?php
            
            break;
        case 5: // lezione su richiesta
            $result2 = $conn->query("SELECT * FROM richieste_lezioni WHERE id = '$id'");
            $richiesta = $result2->fetch_assoc();
                if ($mese_in_stampa != $mese) {
                    if ($mese_in_stampa != "") {
                        ?>
            <tr>
		<td colspan=5><b>Totale mensile: <?php echo $totale_mensile;?>&nbsp;&euro;</b></td>
	</tr>
        <?php
                    }
                    $totale_mensile = $prodotto['prezzo'];
                    $mese_in_stampa = $mese;
                    ?>
        <tr>
		<td colspan=5>Mese di&nbsp; <?php echo $mese;?>&nbsp; <?php echo $data['anno'];?></td>
	</tr>
    <?php
                } else {
                    $totale_mensile = $totale_mensile + $prodotto['prezzo'];
                }
                ?>
	               <tr style="height: 60px">
		<td><?php echo $richiesta['id'];?></td>
		<td><?php echo $data['giorno'] . "/" . $data['mese'] . "/". $data['anno']; ?></td>
		<td>Lezione su richiesta</td>
		<td><?php echo $richiesta['titolo'];?></td>
		<td><?php echo $richiesta['prezzo'];?>&euro;</td>

	</tr>
	               <?php
            
            break;
        default:
            break;
    }
    if ($riga_corrente == $numero_righe) {
        ?>
	                    <tr style="height: 60px">
		<td colspan=5><b><?php echo "Totale mensile: " . $totale_mensile?>&euro;</b></td>
	</tr>
	                    <?php
    }
}
?>
	<tr>
		<td align="center" id="indietro" colspan=5><strong><a
				href="home-insegnante.html"> Indietro</a></strong></td>
	</tr>
</table>