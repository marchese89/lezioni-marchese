<table id="pannello_controllo" align="center" cellspacing=0 cellpadding=0 width="100%"> 
	<tr id="titolo">
		<th style="height: 60px" align="center"><span
			style="color: #0e83cd; font-size: 24px">Richieste Lezioni</span><br></th>
	</tr>
	<?php 
	$id_studente = trovaIdStudente($_SESSION['user'],$conn);
	$result = $conn->query("SELECT * FROM richieste_lezioni WHERE studente='$id_studente' AND evasa = '0'");
	while($richiesta = $result->fetch_assoc()){
	    ?>
	    <tr style="height: 60px">
	    <td>
	    <label><?php echo $richiesta['titolo']?></label><span>    </span><button onclick=location.href="visualizza-richiesta-lezione-<?php echo $richiesta['id'];?>.html">Visualizza</button>
	    </td>
	    </tr>
	    <?php 
	}
	?>
	
	<tr>
	<td align="center" id="indietro"><strong><a href="home-user.html">
				Indietro</a></strong></td>
</tr>
</table>