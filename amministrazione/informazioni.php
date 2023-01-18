<?php 
$result =  $conn->query("SELECT * FROM amministratore");
$amministratore = $result->fetch_assoc();
?>
<table id="pannello_controllo">
	<tr id="titolo">
		<th valign="center" height="100"
			style="font-size: 24px; color: #0e83cd;" colspan="2">Informazioni</th>
	</tr>
	<tr>
		<td><?php echo $amministratore['nome'] . " " . $amministratore['cognome'];?></td>
	</tr>
	<tr>
		<td><p><img src="<?php echo $amministratore['foto'];?>" height="250"
			width="250"></td>
	</tr>
	<?php 
	$res0 = $conn->query("SELECT * FROM certificati ORDER BY numero ASC");
	while($cert = $res0->fetch_assoc()){
	    ?>
	    <tr>
	    <td><label><?php echo $cert['nome'];?></label></td>
	    </tr>
	    <tr>
	    <td>
	    <iframe src="<?php echo $cert['percorso'];?>#view=FitH" width="90%" height="800px"></iframe>
		</td>
		</tr>
	    <?php
	}
	?>
	<tr>
	<td><label>Valutazione dei Clienti:  </label><?php echo number_format(punteggioInsegnante($conn),2);?>/5 Stelle</td>
	</tr>
	<tr>
	<td>
	<label style="font-size:20px">Recensioni Clienti</label>
	</td>
	</tr>
	<?php 
	$result2 = $conn->query("SELECT * FROM feedback WHERE recensione <> '' OR recensione <> NULL");
	while($feed = $result2->fetch_assoc()){
	    $recensione = $feed['recensione'];
	    $id_studente = $feed['studente'];
	    $result3 = $conn->query("SELECT * FROM studente WHERE id = '$id_studente'");
	    $studente = $result3->fetch_assoc();
	    $id_utente = $studente['utente_s'];
	    $result4 = $conn->query("SELECT * FROM utente WHERE id = '$id_utente'");
	    $utente = $result4->fetch_assoc();
	    ?>
	    <tr>
	    <td>
	    <label>Recensione di <?php echo $utente['nome'] . " " .  $utente['cognome'];?></label>
	    </td>
	    </tr>
	    <tr>
	    <td>
	    <?php echo $recensione;?>
	    </td>
	    </tr>
	    <?php
	}
	?>
</table>