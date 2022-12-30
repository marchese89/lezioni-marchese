<?php
$corso = $_GET['id_corso'];
?>
<table id="pannello_controllo" >

	<tr id="titolo">
		<th>Modifica Esercizio</th>
	</tr>
		<tr><td>	
	<?php
$id_esercizio = $_GET['id'];

$result0 = $conn->query("SELECT * FROM esercizio WHERE id='$id_esercizio'");
$esercizio = $result0->fetch_assoc();
$id_corso = $esercizio['corso_ex'];
$result = $conn->query("SELECT * FROM corso WHERE id='$id_corso'");
$r = $result->fetch_assoc();
$id_mat = $r['materia'];
$result2 = $conn->query("SELECT * FROM materia WHERE id='$id_mat'");
$row2 = $result2->fetch_assoc();
$id_a_t = $row2['area_tematica'];
$result3 = $conn->query("SELECT * FROM area_tematica WHERE id='$id_a_t'");
$row3 = $result3->fetch_assoc();
echo "<label>Area Tematica:</label> " . $row3['nome'] . " - <label>Materia:</label> " . $row2['nome'] . " - <label>Corso:</label> " . $r['nome'];

?>
</td>
</tr>
<form action="insegnanti/modifica-esercizio.php" method="post">
<input type="hidden" name="id_corso" value="<?php echo $corso;?>">
<input type="hidden" name="id" value="<?php echo $_GET['id']?>">

	<tr>
		<td>
	<label>Titolo</label>&nbsp;<input type="text" name="titolo_esercizio"
			id="titolo_esercizio" maxlength="45" size="24" autofocus="true"
			value="<?php echo $esercizio['titolo'];?>"> <script
				type="text/javascript">
                                    var titolo_esercizio = new LiveValidation('titolo_esercizio', {onlyOnSubmit: true});
                                    titolo_esercizio.add(Validate.Presence);
                                    titolo_esercizio.add(Validate.TestoEnumeri);
                                </script></td>
	</tr>

	<tr>
		<td><label>Prezzo</label>&nbsp;<input type="text" name="prezzo_esercizio"
			id="prezzo_esercizio" maxlength="45" size="24" autofocus="true"
			value="<?php echo $esercizio['prezzo'];?>"> <b> &euro;</b> <script
				type="text/javascript">
                                    var prezzo_esercizio = new LiveValidation('prezzo_esercizio', {onlyOnSubmit: true});
                                    prezzo_esercizio.add(Validate.Presence);
                                    prezzo_esercizio.add(Validate.soloNumeri);
                                </script></td>
	</tr>
	
	<tr>
		<td><input type="submit" value="Modifica Esercizio"></td>
	</tr>
</form>
	<tr>
	<td><label>Traccia Esercizio</label></td>
	</tr>
	<tr>
	<td><iframe src="<?php echo $esercizio['traccia'];?>#view=FitH" width="90%" height="800px"></iframe></td>
</tr>
<tr>
		<td><button class="button" onclick=location.href="modifica-file-t-esercizio-<?php echo $corso;?>-<?php echo $id_esercizio;?>.html">Modifica Traccia Esercizio</button></td>
	</tr>
	<tr>
	<td><label>Svolgimento Esercizio</label></td>
	</tr>
	<tr>
	<td><iframe src="<?php echo $esercizio['svolgimento'];?>#view=FitH" width="90%" height="800px"></iframe></td>
</tr>
<tr>
		<td><button class="button" onclick=location.href="modifica-file-s-esercizio-<?php echo $corso;?>-<?php echo $id_esercizio;?>.html">Modifica Svolgimento Esercizio</button></td>
	</tr>
	<td align="center" id="indietro"><strong><a href="corso-ins-<?php echo $corso;?>.html">
				Indietro</a></strong></td>
</tr>
</table>