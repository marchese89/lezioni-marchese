<?php
$mat = $_GET['mat'];
$at = $_GET['at'];
$id_ins = $_GET['id_ins'];
?>
<table id="pannello_controllo">
	<tr id="titolo">
		<th colspan="5">Titolo Richiesta</th>
	</tr>
	<tr style="height: 120px">
	<td>
	<form action="studenti/carica-richiesta-lezione.php" method="post">
	<input type="hidden" name="id_ins" value="<?php echo $id_ins;?>">
	<label>Titolo Lezione </label><input type="text" id="titolo_l"
		name="titolo_l" maxlength="45" size="30">
	<script type="text/javascript">
                                    var titolo_l_ = new LiveValidation('titolo_l', {onlyOnSubmit: true});
                                    titolo_l_.add(Validate.Presence);
                                    titolo_l_.add(Validate.SoloTesto);
                                </script>
	<br> <br> <input type="submit" value="Invia Richiesta">
</form>
	</td>
	</tr>
<tr>
		<td align="center" id="indietro" colspan="5"><strong><a
				href="dettagli-insegnante-<?php echo $id_ins;?>-<?php echo $mat;?>-<?php echo $at;?>.html">
					Indietro</a></strong></td>
	</tr>
</table>