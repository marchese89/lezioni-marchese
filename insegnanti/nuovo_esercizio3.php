<?php
$corso = $_GET['id_corso'];
?>
<table id="pannello_controllo" >
		
	<tr id="titolo">
		<th>Inserisci nuovo Esercizio (3)</th>
	</tr>
<form action="insegnanti/inserisci_esercizio.php" method="post" >
	<input type="hidden" name="corso" value="<?php echo $corso;?>">
	<tr>
		<td><label>Titolo</label><input type="text" name="titolo_esercizio"
			id="titolo_esercizio" maxlength="45" size="24" autofocus="true"> <script
				type="text/javascript">
                                    var titolo_esercizio = new LiveValidation('titolo_lezione', {onlyOnSubmit: true});
                                    titolo_esercizio.add(Validate.Presence);
                                    titolo_esercizio.add(Validate.TestoEnumeri);
                                </script></td>
	</tr>

	<tr>
		<td><label>Prezzo</label><input type="text" name="prezzo_esercizio"
			id="prezzo_esercizio" maxlength="45" size="24" autofocus="true"> <b>
				&euro;</b> <script type="text/javascript">
                                    var prezzo_esercizio = new LiveValidation('prezzo_esercizio', {onlyOnSubmit: true});
                                    prezzo_esercizio.add(Validate.Presence);
                                    prezzo_esercizio.add(Validate.soloNumeri);
                                </script></td>
	</tr>
	
	<tr>
		<td><input type="submit" value="Inserisci Esercizio"></td>
	</tr>
</form>
</table>