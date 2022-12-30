<?php
$corso = $_GET['id_corso'];
?>
<table id="pannello_controllo" >

	<tr id="titolo">
		<th>Modifica Lezione</th>
	</tr>


<form action="insegnanti/modifica-lezione.php" method="post">
<input type="hidden" name="id_corso" value="<?php echo $corso;?>">
	<tr>

		<td>
				
	<?php
$id_lezione = $_GET['id'];

$result0 = $conn->query("SELECT * FROM lezione WHERE id='$id_lezione'");
$lezione = $result0->fetch_assoc();
$id_corso = $lezione['corso_lez'];
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
	 <input type="hidden" name="id"
			value="<?php echo $_GET['id']?>"></td>

	</tr>

	<tr>
		<td><label>Numero</label><input type="text" name="numero_lezione"
			id="numero_lezione" maxlength="45" size="24" autofocus="true"
			value="<?php echo $lezione['numero'];?>"> <script
				type="text/javascript">
                                    var numero_lezione = new LiveValidation('numero_lezione', {onlyOnSubmit: true});
                                    numero_lezione.add(Validate.Presence);
                                    numero_lezione.add(Validate.soloNumeri);
                                </script></td>
	</tr>

	<tr>
		<td><label>Titolo</label><input type="text" name="titolo_lezione"
			id="titolo_lezione" maxlength="45" size="24" autofocus="true"
			value="<?php echo $lezione['titolo'];?>"> <script
				type="text/javascript">
                                    var titolo_lezione = new LiveValidation('titolo_lezione', {onlyOnSubmit: true});
                                    titolo_lezione.add(Validate.Presence);
                                    titolo_lezione.add(Validate.TestoEnumeri);
                                </script></td>
	</tr>

	<tr>
		<td><label>Prezzo</label><input type="text" name="prezzo_lezione"
			id="prezzo_lezione" maxlength="45" size="24" autofocus="true"
			value="<?php echo $lezione['prezzo'];?>"> <b> &euro;</b> <script
				type="text/javascript">
                                    var prezzo_lezione = new LiveValidation('prezzo_lezione', {onlyOnSubmit: true});
                                    prezzo_lezione.add(Validate.Presence);
                                    prezzo_lezione.add(Validate.soloNumeri);
                                </script></td>
	</tr>
	
	<tr>
		<td><input type="submit" value="Modifica Lezione"></td>
	</tr>
</form>
	<tr>
	<td><label>Presentazione Lezione</label></td>
	</tr>
	<tr>
	<td><iframe src="<?php echo $lezione['presentazione'];?>#view=FitH" width="90%" height="800px"></iframe></td>
</tr>
<tr>
		<td><button class="button" onclick=location.href="modifica-file-p-lezione-<?php echo $corso;?>-<?php echo $id_lezione;?>.html">Modifica Presentazione Lezione</button></td>
	</tr>
	<tr>
	<td><label>Lezione</label></td>
	</tr>
	<tr>
	<td><iframe src="<?php echo $lezione['lezione'];?>#view=FitH" width="90%" height="800px"></iframe></td>
</tr>
<tr>
		<td><button class="button" onclick=location.href="modifica-file-lezione-<?php echo $corso;?>-<?php echo $id_lezione;?>.html">Modifica File Lezione</button></td>
	</tr>
	<td align="center" id="indietro"><strong><a href="corso-ins-<?php echo $corso;?>.html">
				Indietro</a></strong></td>
</tr>
</table>