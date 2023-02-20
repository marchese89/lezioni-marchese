<table align="center" width="100%" id="pannello_controllo" cellspacing=0
	cellpadding=0 >

	<tr id="titolo">
		<th colspan=4>Lezioni su Richiesta Acquistate</th>
	</tr>
	<tr style="height: 60px">
	<td><label>Id</label></td>
	<td><label>Titolo</label></td>
	<td><label>Traccia/Svolgimento</label></td>
	       </tr>
	<?php 
	   $id_studente = trovaIdStudente($_SESSION['user'],$conn);
	   $result = $conn->query("SELECT * FROM richieste_lezioni WHERE studente = '$id_studente' AND pagata = '1' ORDER  BY data DESC");
	   while($richiesta = $result->fetch_assoc()){
	       ?>
	       <tr style="height: 60px">
	       <td><?php echo $richiesta['id'];?></td>
		   <td><?php echo $richiesta['titolo'];?></td>
		   <td><button onclick=location.href="visualizza_svolgimento-<?php echo $richiesta['id'];?>.html">Visualizza</button></td>
	       </tr>
	       <?php 
	   }
	   ?>
	<tr>

			<td align="center" id="indietro" colspan=4><strong><a
					href="home-user.html">
					Indietro</a></strong></td>
		</tr>
</table>