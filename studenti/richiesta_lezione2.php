<table id="pannello_controllo">
	<tr id="titolo"><th colspan="5">Area Tematica</th></tr>
	<?php 
	$result = $conn->query("SELECT * FROM area_tematica");
	while($at = $result->fetch_assoc()){
	   
	    ?>
	    <tr>
	    <td><a href="richiesta_lezione3-<?php echo $at['id'];?>.html"><?php echo $at['nome'];?></a></td>
	    </tr>
	    <?php 
	}
	?>
	
	<tr>
			<td align="center" id="indietro"><strong><a
					href="lezioni-su-richiesta.html">
					Indietro</a></strong></td>
		</tr>
</table>