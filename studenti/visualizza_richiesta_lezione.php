<?php 
$id = $_GET['id'];
?>

<table id="pannello_controllo" align="center" cellspacing=0 cellpadding=0 width="100%"> 
	<tr id="titolo">
		<th style="height: 60px" align="center" colspan=3><span
			style="color: #0e83cd; font-size: 24px">Richiesta Lezione <?php echo $id;?></span><br></th>
	</tr>
	<tr style="height: 60px" >
	<td colspan=3>
	<label>Traccia</label>
	</td>
	</tr>
	<?php 
	
	$result = $conn->query("SELECT * FROM richieste_lezioni WHERE id='$id'");
	$richiesta = $result->fetch_assoc();
	
	?>
	<tr>
	<td colspan=3>
	<iframe src="<?php echo $richiesta['traccia'];?>#view=FitH" width="90%" height="800px"></iframe>
	</td>
	</tr>
	<tr>
	<tr style="height: 60px">
	<td  colspan=3>
	<label>Soluzione</label>
	</td>
	</tr>
	<tr style="height: 60px">
	<td><label>Insegnante</label></td>
	<td><label>Prezzo</label></td>
	<td><label>Operazioni</label></td>
	</tr>
	<?php
	   $result = $conn->query("SELECT * FROM richieste_lezioni WHERE id = '$id'");
	   while($richiesta = $result->fetch_assoc()){
	       $id_ins = $richiesta['insegnante'];
	       $result2 = $conn->query("SELECT * FROM insegnante WHERE id = '$id_ins'");
	       $ins = $result2->fetch_assoc();
	       $id_ut = $ins['utente_i'];
	       $result3 = $conn->query("SELECT * FROM utente WHERE id = '$id_ut'");
	       $ut = $result3->fetch_assoc();
	       
	       ?>
	       <tr style="height: 60px"><td>
	       <?php echo $ut['nome'] . " " . $ut['cognome'];?>
	       </td>
	       <td><?php echo $richiesta['prezzo']?> &euro;</td>
	       <td><button onclick=location.href="acquisti/aggiungi_al_carrello.php?id=<?php echo $richiesta['id'];?>&tipo=lez_r&ret=<?php echo  $id;?>">Acquista</button></td>
	       </tr>
	       <?php 
	   }
	?>
	<tr>
	<td align="center" id="indietro" colspan=3><strong><a href="richieste-lezioni.html">
				Indietro</a></strong></td>
</tr>
</table>