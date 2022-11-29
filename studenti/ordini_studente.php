<table align="center" width="100%" id="pannello_controllo" cellspacing=0
	cellpadding=0>

	<tr id="titolo">
		<th colspan="3" >Ordini Effettuati</th>
	</tr>
	<tr style="height: 60px">
		<td><label>Id</label></td>
		<td><label>Data</label></td>
		<td><label>Fattura</label></td>
	</tr>
	<?php 
	$id_studente = trovaIdStudente($_SESSION['user'], $conn);
	$result = $conn->query("SELECT * FROM ordine WHERE cliente = '$id_studente' ORDER BY data DESC");
	while($ordine =  $result->fetch_assoc()){
	    ?>
	    <tr style="height: 60px">
		<td><?php echo $ordine['id'];?></td>
		<td>
		<?php 
		$d = stampa_data($ordine['data']);
	    echo $d['giorno']. '-'. $d['mese']. '-'. $d['anno']. '-'. $d['ora'];?>
	    </td>
	    <td><button onclick=location.href="visualizza-fattura-<?php echo $ordine['id'];?>.html">Visualizza</button></td>
	</tr>
	    <?php 
	}
	?>
	<tr>
		<td align="center" id="indietro" colspan="3"><strong><a href="home-user.html">
					Indietro</a></strong></td>
	</tr>
</table>