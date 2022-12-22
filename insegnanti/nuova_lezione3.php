<?php
$corso = $_GET['id_corso'];

?>
<table id="pannello_controllo">

	<tr id="titolo">
		<th>Inserisci nuova Lezione (3)</th>
	</tr>

<form action="insegnanti/inserisci_lezione.php" method="post">
<input  type="hidden" name="corso" value="<?php echo $corso;?>">

	<tr>
		<td><label>Numero</label><input type="text" name="numero_lezione"
			id="numero_lezione" maxlength="45" size="24" autofocus="true"> <script
				type="text/javascript">
                                    var numero_lezione = new LiveValidation('numero_lezione', {onlyOnSubmit: true});
                                    numero_lezione.add(Validate.Presence);
                                    numero_lezione.add(Validate.soloNumeri);
                                </script></td>
	</tr>

	<tr>
		<td><label>Titolo</label><input type="text" name="titolo_lezione"
			id="titolo_lezione" maxlength="45" size="24" autofocus="true"> <script
				type="text/javascript">
                                    var titolo_lezione = new LiveValidation('titolo_lezione', {onlyOnSubmit: true});
                                    titolo_lezione.add(Validate.Presence);
                                    titolo_lezione.add(Validate.TestoEnumeri);
                                </script></td>
	</tr>

	<tr>
		<td><label>Prezzo</label><input type="text" name="prezzo_lezione"
			id="prezzo_lezione" maxlength="45" size="24" autofocus="true"> <b>
				&euro;</b> <script type="text/javascript">
                                    var prezzo_lezione = new LiveValidation('prezzo_lezione', {onlyOnSubmit: true});
                                    prezzo_lezione.add(Validate.Presence);
                                    prezzo_lezione.add(Validate.soloNumeri);
                                </script></td>
	</tr>
	<tr>
		<td><input type="submit" value="Inserisci Lezione"></td>
	</tr>
	<td id="indietro"><strong><a href="nuova-lezione-<?php echo $corso;?>.html">
				Indietro</a></strong></td>
</tr>
</form>
</table>