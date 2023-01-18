<table id="pannello_controllo">
	<tr id="titolo">
		<th valign="center" height="100"
			style="font-size: 24px; color: #0e83cd;" colspan="3">Elenco Fatture</th>
	</tr>
	<tr>
	    <td><label>Numero</label></td>
	    <td><label>Data</label></td>
	    <td><label>File</label></td>
	    </tr>
	<?php 
	$res = $conn->query("SELECT * FROM fatture ORDER BY data DESC");
	while($fattura = $res->fetch_assoc()){
	    ?>
	    <tr>
	    <td><?php echo $fattura['numero'];?></td>
	    <td><?php 
	    //echo stampa_data($fattura['data']);
	    echo $fattura['data'];
	    ?></td>
	    <td><button onclick=location.href="mostra-fattura-<?php echo $fattura['numero'];?>.html">File</button></td>
	    </tr>
	    <?php 
	}
	?>
	<tr>
		<td align="center" id="indietro" colspan="3" ><strong><a
				href="home-insegnante.html"> Indietro</a></strong></td>
	</tr>
</table>