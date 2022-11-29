<table id="pannello_controllo" align="center" cellspacing=0
	cellpadding=0 width="100%">
	<tr id="titolo">
		<th colspan=4>Richieste degli Studenti</th>
	</tr>
	<tr style="height: 60px">
	<td style="width: 40%"><label>Id</label></td>
	<td><label>Nome</label></td>
	<td><label>Data</label></td>
	<td><label>Operazioni</label></td>
	</tr>
	<?php 
	$result = $conn->query("SELECT * FROM richieste_lezioni WHERE evasa='0' ORDER BY data DESC");
	while($richiesta = $result->fetch_assoc()){
	    ?>
	    <tr style="height: 60px">
	    <td><?php echo $richiesta['id'];?></td>
	    <td><?php echo $richiesta['titolo'];?></td>
	    <td>
	    <?php 
	    $d = stampa_data($richiesta['data']);
	    echo $d['giorno']. '-'. $d['mese']. '-'. $d['anno']. '-'. $d['ora'];
	    ?>
	    </td>
	    <td>
	    <button onclick=location.href="visualizza-richiesta-lezione-i-<?php echo $richiesta['id'];?>.html">Visualizza</button>
	    </td>
	    </tr> 
	    <?php 
	}
	?>
</table>