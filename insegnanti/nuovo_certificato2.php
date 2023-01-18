<table id="pannello_controllo">
	<tr id="titolo">
		<th>Nuovo Certificato</th>
	</tr>

<form action="insegnanti/carica-certificato.php" method="post">
<tr><td>
	<label>Numero Certificato </label>
</td>
</tr>
<tr><td>	
<input type="text" id="num_cert"
		name="num_cert" maxlength="45" size="30">
	<script type="text/javascript">
                                    var num_cert_ = new LiveValidation('num_cert', {onlyOnSubmit: true});
                                    num_cert_.add(Validate.Presence);
                                    num_cert_.add(Validate.InteriPositivi);
                                </script>
                                </td>
                                </tr>
    <tr><td>                            
	<label>Titolo Certificato </label>
	</td>
	</tr>
	<tr>
	<td>
	<input type="text" id="titolo_c"
		name="titolo_c" maxlength="45" size="30">
	<script type="text/javascript">
                                    var titolo_c_ = new LiveValidation('titolo_c', {onlyOnSubmit: true});
                                    titolo_c_.add(Validate.Presence);
                                    titolo_c_.add(Validate.SoloTesto);
                                </script>
                                </td>
                                </tr>
    <tr>
    <td>                            
	<input type="submit" value="Cartica Certificato">
	</td>
	</tr>
</form>

<tr>
			<td align="center" id="indietro"><strong><a
					href="nuovo-certificato.html">
					Indietro</a></strong></td>
		</tr>
</table>