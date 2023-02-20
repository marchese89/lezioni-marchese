<?php 
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM richieste_lezioni WHERE id='$id'");
$richiesta = $result->fetch_assoc();
?>

<table id="pannello_controllo" align="center" cellspacing=0 cellpadding=0 width="100%"> 
	<tr id="titolo">
		<th style="height: 60px" align="center" colspan=3><span
			style="color: #0e83cd; font-size: 24px">Richiesta Lezione: "<?php echo $richiesta['titolo'];?>"</span><br></th>
	</tr>
	<tr style="height: 60px" >
	<td colspan=3>
	<label>Traccia</label>
	</td>
	</tr>
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
	<td><label>Prezzo</label></td>
	<td><label>Operazioni</label></td>
	</tr>
	<?php
	   $result = $conn->query("SELECT * FROM richieste_lezioni WHERE id = '$id' AND svolgimento <> 'NULL'");
	   if($result->num_rows > 0){
	   $richiesta = $result->fetch_assoc();
        ?>
	       <td><?php echo $richiesta['prezzo']?> &euro;</td>
	       <td><button onclick=location.href="acquisti/aggiungi_al_carrello.php?id=<?php echo $richiesta['id'];?>&tipo=lez_r&ret=<?php echo  $id;?>">Acquista</button></td>
	       </tr>
	       <?php 
	       }else{
	           ?>
	           <tr style="height: 60px"><td colspan=3>
	           <font style="font-size: 18px"  color=red>Al momento non esistono svolgimenti per questa lezione</font>
	           </td>
	           </tr>
	           <?php 
	       }
	       ?>
	<tr>
	<td align="center" id="indietro" colspan=3><strong><a href="richieste-studenti.html">
				Indietro</a></strong></td>
</tr>
</table>