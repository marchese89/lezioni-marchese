
<table id="pannello_controllo" >
	<tr id="titolo">
		<th>Elenco Corsi
		</th>
	</tr>
	<?php 
	$id_ins = trovaIdInsegnante($_SESSION['user'], $conn);
	$result = $conn->query("SELECT * FROM corso WHERE insegnante= '$id_ins'");
	while($corso = $result->fetch_assoc()){
	    ?>
	    <tr>
	    <td><a href="corso-ins-<?php echo $corso['id']?>.html"><?php echo $corso['nome']?></a></td>
	    </tr>
	    <?php 
	}
	?>
	<tr>
	<td id="indietro"><strong><a href="corsi.html">
				Indietro</a></strong></td>
</tr>
</table>