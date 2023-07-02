<?php
if (! $conn) {
    header("Location: ../index.php");
}
$ritorno;
if (! empty($_GET['return'])) {
    $ritorno = $_GET['return'];
}
?>
<script>
    function mostraPassword1() {
    	  var x = document.getElementById("pass1");
    	  if (x.type === "password") {
    	    x.type = "text";
    	  } else {
    	    x.type = "password";
    	  }
    	}
    function mostraPassword2() {
  	  var x = document.getElementById("pass2");
  	  if (x.type === "password") {
  	    x.type = "text";
  	  } else {
  	    x.type = "password";
  	  }
  	}

    function modifica_pass(){
    	var x = document.getElementById("pass1");
    	if (x.type === "text") {
    	    x.type = "password";
    	  }
    	var y = document.getElementById("pass2");
    	if (x.type === "text") {
      	    x.type = "password";
      	  }
    }
    </script>
<form
	action="amministrazione/risultato_registrazione.php<?php if(!empty($ritorno)){echo '?return=ok';}?>"
	method="post" onsubmit="modifica_pass()">
	<table  id="pannello_controllo" >
	<tr id="titolo" >
			<th valign="center" height="100"
				style="font-size: 24px; color: #0e83cd;" colspan="2">Iscrizione</th>
		</tr>
	<tr><td>
	<table cellspacing="0" cellpadding="0" align="center"
		style="border-collapse: collapse;width:40%;" RULES=none FRAME=none id="pannello_controllo" >
		
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

		<tr>
			<th valign="middle" align="center" height="60" width="78">
				<p style="color: #0e83cd">Email</p>
				<p>
					<input type="text" name="email1" id="email1" maxlength="45"
						size="30">
					<script type="text/javascript">
                                    var email1 = new LiveValidation('email1', {onlyOnSubmit: true});
                                    email1.add(Validate.Presence);
                                    email1.add(Validate.Email);
                                </script>
				</p>
			</th>
			<th valign="middle" align="center" height="60" width="78">
				<p style="color: #0e83cd">Conferma Email</p>
				<p>
					<input type="text" name="email2" id="email2" maxlength="45"
						size="30">
				</p> <script type="text/javascript">
                                var email2 = new LiveValidation('email2', {onlyOnSubmit: true});
                                email2.add(Validate.Presence);
                                email2.add(Validate.Email);
                                email2.add(Validate.Confirmation, {match: 'email1'});
                            </script>
			</th>

		</tr>


		<tr>
			<th valign="middle" align="center" height="60" width="78">
				<p style="color: #0e83cd">Password</p>
				<p>
					<input type="password" id="pass1" name="pass1" maxlength="45"
						size="30"><i class="bi bi-eye-slash" id="togglePassword"></i>
					<script type="text/javascript">
                                    var pass1_ = new LiveValidation('pass1', {onlyOnSubmit: true});
                                    pass1_.add(Validate.Presence);
                                    pass1_.add(Validate.Pass);
                                </script>
				</p> <input type="checkbox" onclick="mostraPassword1()">Mostra
				Password
			</th>
			<th valign="middle" align="center" height="80" width="78">
				<p style="color: #0e83cd">Conferma Password</p>
				<p>
					<input type="password" name="pass2" id="pass2" maxlength="45"
						size="30">
					<script type="text/javascript">
                                    var pass2_ = new LiveValidation('pass2', {onlyOnSubmit: true});
                                    pass2_.add(Validate.Presence);
                                    pass2_.add(Validate.Confirmation, {match: 'pass1'});
                                </script>
				</p> <input type="checkbox" onclick="mostraPassword2()">Mostra
				Password
				<p>
			
			</th>

		</tr>
		<tr>
			<th colspan="2"><label>La password deve essere lunga alemno 10
					caratteri,
					<p>contenere almeno una lettera maiuscola e una minuscola,
					
					<p>un numero, e uno tra i seguenti caratteri speciali: @ # ! ? . ,
						; :
					
					<p>non deve inoltre contenere più di due cifre uguali ripetute o
						più di due lettere ripetute
					
			</label></th>
		</tr>
		<tr>
			<th colspan="2" height="300px" style="color: #0e83cd">Informativa sul
				trattamento dei dati personali<br>
			<p>
					<textarea rows="10" cols="60" disabled style="resize: none">Ai sensi dell'articolo 13 del D.lgs n.196/2003, Le/Vi forniamo le seguenti informazioni:
1. I dati personali da Lei/Voi forniti o acquisiti nell&apos;ambito della nostra attivit&agrave; saranno oggetto di trattamento improntato ai principi di correttezza, liceit&agrave;, trasparenza e di tutela della Sua/Vostra riservatezza e dei Suoi/Vostri diritti.
2. Il trattamento di tali dati personali sar&agrave; finalizzato agli adempimenti degli obblighi contrattuali o derivanti da incarico conferito dall&apos;interessato ed in particolare all&apos;invio telematico di eventuali fatture.
3. Il trattamento potr&agrave; essere effettuato anche con l&apos;ausilio di strumenti elettronici con modalit&agrave; idonee a garantire la sicurezza e riservatezza dei dati.
4. Il conferimento dei dati &egrave; obbligatorio. L&apos;eventuale rifiuto a fornirci, in tutto o in parte, i Suoi/Vostri dati personali o l&apos;autorizzazione al trattamento implica l&apos;impossibilit&agrave; di iscriversi al sito.
5. I dati potranno essere comunicati, esclusivamente per le finalit&agrave; sopra indicate, a soggetti determinati al fine di adempiere agli obblighi di cui sopra. Altri soggetti potrebbero venire a conoscenza dei dati in qualit&agrave; di responsabili o incaricati del trattamento o in qualit&agrave; di gestori e manutentori del sito stesso. In nessun caso i dati personali trattati saranno oggetto di diffusione.
7. Il titolare del trattamento dei dati personali &egrave; Antonio Giovanni Marchese con sede in Via Teodoro Mesimerrio, 1 - 89822 Spadola VV
Il responsabile del trattamento dei dati personali &egrave; Antonio Giovanni Marchese
8. Al titolare del trattamento o al responsabile Lei/Voi potr&agrave; rivolgersi per far valere i Suoi diritti, cos&igrave; come previsto dall&apos;articolo 7 del D.lgs n.196/2003, che per Sua/Vostra comodit&agrave; riproduciamo integralmente:
Art. 7 Diritto di accesso ai dati personali ed altri diritti

1. L&apos;interessato ha diritto di ottenere la conferma dell&apos;esistenza o meno di dati personali che lo riguardano, anche se non ancora registrati, e la loro comunicazione in forma intelligibile.
2. L&apos;interessato ha diritto di ottenere l&apos;indicazione:
a) dell&apos;origine dei dati personali;
b) delle finalit&agrave; e modalit&agrave; del trattamento;
c) della logica applicata in caso di trattamento effettuato con l&apos;ausilio di strumenti elettronici;
d) degli estremi identificativi del titolare, dei responsabili e del rappresentante designato ai sensi dell&apos;articolo 5, comma 2;
e) dei soggetti o delle categorie di soggetti ai quali i dati personali possono essere comunicati o che possono venirne a conoscenza in qualit&agrave; di rappresentante designato nel territorio dello Stato, di responsabili o incaricati.

3. L&apos;interessato ha diritto di ottenere:
a) l&apos;aggiornamento, la rettificazione ovvero, quando vi ha interesse, l&apos;integrazione dei dati;
b) la cancellazione, la trasformazione in forma anonima o il blocco dei dati trattati in violazione di legge, compresi quelli di cui non &egrave; necessaria la conservazione in relazione agli scopi per i quali i dati sono stati raccolti o successivamente trattati;
c) l&apos;attestazione che le operazioni di cui alle lettere a) e b) sono state portate a conoscenza, anche per quanto riguarda il loro contenuto, di coloro ai quali i dati sono stati comunicati o diffusi, eccettuato il caso in cui tale adempimento si rivela impossibile o comporta un impiego di mezzi manifestamente sproporzionato rispetto al diritto tutelato.

4. L&apos;interessato ha diritto di opporsi, in tutto o in parte:
a) per motivi legittimi al trattamento dei dati personali che lo riguardano, ancorch&eacute; pertinenti allo scopo della raccolta;
b) al trattamento di dati personali che lo riguardano a fini di invio di materiale pubblicitario o di vendita diretta o per il compimento di ricerche di mercato o di comunicazione commerciali
                            </textarea>
			
			</th>
		</tr>
		<tr>
			<th colspan="2" height="40px" style="color: #0e83cd">Ho letto
				l'informativa <input type="checkbox" style="font-size: x-large"
				name="info" id="info"> &nbsp; <script type="text/javascript">
                                    var info_ = new LiveValidation('info', {onlyOnSubmit: true});
                                    info_.add(Validate.Acceptance);
                                </script>
			</th>
		</tr>
		<tr>
			<th colspan="2" align="center" height="70px">
				<p>
					<input type="submit" class="submit" name="iscrizione"
						value="Conferma">
				</p> <br>
				<p>
			
			</th>

		</tr>
	</table>
	</td>
	</tr>
	</table>
</form>


