
<form action="amministrazione/crea_fattura.php" method="post" >
<table id="pannello_controllo">
	<tr id="titolo">
		<th>Nuova Fattura</th>
	</tr>
	<tr>
		<th>
			<table id="pannello_controllo" style="width: 40%;">
				<tr>
					<th colspan=2><font style="font-size: 20px">Dati Cliente</font></th>
				</tr>
				<tr>

					<th valign="middle" align="center" height="60" width="98">
						<p style="color: #0e83cd">Nome</p>
						<p>
							<input type="text" id="nome" name="nome" maxlength="45" size="30">
							<script type="text/javascript">
                                    var nome_ = new LiveValidation('nome', {onlyOnSubmit: true});
                                    nome_.add(Validate.Presence);
                                    nome_.add(Validate.SoloTesto);
                                </script>
						</p>
					</th>

					<th valign="middle" align="center" height="60" width="98">
						<p style="color: #0e83cd">Cognome</p>
						<p>
							<input type="text" id="cognome" name="cognome" maxlength="45"
								size="30">
							<script type="text/javascript">
                                    var cognome_ = new LiveValidation('cognome', {onlyOnSubmit: true});
                                    cognome_.add(Validate.Presence);
                                    cognome_.add(Validate.SoloTesto);
                                </script>
						</p>
					</th>
				</tr>
				<tr>
					<th valign="middle" align="center" height="60" width="98">
						<p style="color: #0e83cd">Indirizzo (via/piazza)</p>
						<p>
							<input type="text" id="via" name="via" maxlength="255" size="30">
							<script type="text/javascript">
                                    var via_ = new LiveValidation('via', {onlyOnSubmit: true});
                                    via_.add(Validate.Presence);
                                    via_.add(Validate.SoloTesto);
                                </script>
						</p>
					</th>
					<th valign="middle" align="center" height="60" width="98">
						<p style="color: #0e83cd">N.Civico</p>
						<p>
							<input type="text" id="n_civico" name="n_civico" maxlength="6"
								size="30">
							<script type="text/javascript">
                                    var n_civico_ = new LiveValidation('n_civico', {onlyOnSubmit: true});
                                    n_civico_.add(Validate.Presence);
                                </script>
						</p>
					</th>
				</tr>
				<tr>
					<th valign="middle" align="center" height="60" width="98">
						<p style="color: #0e83cd">Citt&agrave;</p>
						<p>
							<input type="text" id="citta" name="citta" maxlength="255"
								size="30">
							<script type="text/javascript">
                                    var citta_ = new LiveValidation('citta', {onlyOnSubmit: true});
                                    citta_.add(Validate.Presence);
                                    citta_.add(Validate.SoloTesto);
                                </script>
						</p>
					</th>
					<th valign="middle" align="center" height="60" width="98">
						<p style="color: #0e83cd">Provincia</p>
						<p>
							<input type="text" id="provincia" name="provincia" maxlength="2"
								size="30">
							<script type="text/javascript">
                                    var provincia_ = new LiveValidation('provincia', {onlyOnSubmit: true});
                                    provincia_.add(Validate.Presence);
                                    provincia_.add(Validate.SoloTesto);
                                </script>
						</p>
					</th>
				</tr>
				<tr>
					<th valign="middle" align="center" height="60" width="98">
						<p style="color: #0e83cd">CAP</p>
						<p>
							<input type="text" id="cap" name="cap" maxlength="5" size="30">
							<script type="text/javascript">
                                    var cap_ = new LiveValidation('cap', {onlyOnSubmit: true});
                                    cap_.add(Validate.Presence);
                                    cap_.add(Validate.InteriPositivi);
                                </script>
						</p>
					</th>
					<th valign="middle" align="center" height="60" width="98">
						<p style="color: #0e83cd">Codice Fiscale</p>
						<p>
							<input type="text" id="cf" name="cf" maxlength="16" size="30">
							<script type="text/javascript">
                                    var cf_ = new LiveValidation('cf', {onlyOnSubmit: true});
                                    cf_.add(Validate.Presence);
                                    cf_.add(Validate.CodiceFiscale);
                                </script>
						</p>
					</th>
				</tr>

			</table>

		</th>
	</tr>
	<tr><th>
	<table id="pannello_controllo" style="width: 40%;">
	<tr>
		<th colspan=2><font style="font-size: 20px">Elemento da fatturare</font></th>
	</tr>
	<tr>
		<th>
			<p style="color: #0e83cd">Descrizione</p>
			<p>
				<input type="text" id="descrizione" name="descrizione"
					maxlength="255" size="30">
				<script type="text/javascript">
                                    var descrizione_ = new LiveValidation('descrizione', {onlyOnSubmit: true});
                                    descrizione_.add(Validate.Presence);
                                    descrizione_.add(Validate.SoloTesto);
                                </script>
			</p>
			</th>
			<th>
						<p style="color: #0e83cd">Prezzo</p>
						<p>
							<input type="text" id="prezzo" name="prezzo" maxlength="10" size="30">
							<script type="text/javascript">
                                    var prezzo_ = new LiveValidation('prezzo', {onlyOnSubmit: true});
                                    prezzo_.add(Validate.Presence);
                                    prezzo_.add(Validate.InteriPositivi);
                                </script>
						</p>
					</th>
					</tr>
					<tr>
		<th>
			<p style="color: #0e83cd">Quantit&agrave;</p>
			<p>
				<input type="text" id="qta" name="qta"
					maxlength="255" size="30">
				<script type="text/javascript">
                                    var qta_ = new LiveValidation('qta', {onlyOnSubmit: true});
                                    qta_.add(Validate.Presence);
                                    qta_.add(Validate.InteriPositivi);
                                </script>
			</p>
			</th>
			<th>
						<p style="color: #0e83cd">Importo</p>
						<p>
							<input type="text" id="importo" name="importo" maxlength="10" size="30">
							<script type="text/javascript">
                                    var importo_ = new LiveValidation('importo', {onlyOnSubmit: true});
                                    importo_.add(Validate.Presence);
                                    importo_.add(Validate.InteriPositivi);
                                </script>
						</p>
					</th>
					</tr>
					</table>
		</th>
	</tr>
		<tr>
		<th colspan="2">
			<p style="color: #0e83cd">Note</p>
			<p>
				<input type="text" id="note" name="note"
					maxlength="255" size="50">
				<script type="text/javascript">
                                    var note_ = new LiveValidation('note', {onlyOnSubmit: true});
                                    note_.add(Validate.Presence);
                                    note_.add(Validate.SoloTesto);
                                </script>
			</p>
			</th>
			</tr>
	<tr>
		<th align="center">
		<input type="submit" value="Crea Fattura">
		</th>
	</tr>
	<tr>
		<td align="center" id="indietro" ><strong><a
				href="home-insegnante.html"> Indietro</a></strong></td>
	</tr>
</table>
</form>