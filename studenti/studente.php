<?php
if (! $conn) {
    header("Location: ../index.html");
}
$email;
if(isset($_SESSION['user'])){
    $email = $_SESSION['user'];
}
$sql = "SELECT * FROM utente WHERE email='$email'";
$result = $conn->query($sql);
$argomento;
if ($result->num_rows > 0) {
    $argomento = $result->fetch_assoc();
}
if ($argomento['stato_account'] === '1') {
    if (isset($_SESSION['user'])) {

        ?>



<table id="pannello_controllo" align="center" cellspacing=0 cellpadding=0 width="100%"> 
	<tr id="titolo">
		<th style="height: 60px" align="center"><span
			style="color: #0e83cd; font-size: 24px">Il mio profilo (Studente)</span><br></th>
	</tr>
	<tr style="height: 60px">
		<th align="center">
            <?php

        $data = $_SESSION['last_login'];
        $anno = substr($data, 0, 4);
        $mese = substr($data, 5, 2);
        $giorno = substr($data, 8, 2);
        $ora = substr($data, 11, 5);
        ?>
                            <span
			style="font-size: 14px; color: #0e83cd;">(Ultimo accesso: <?php echo $giorno . '/' . $mese . '/' . $anno . ' ore '. $ora;?>)</span>
		</th>
	</tr>
	<tr style="height: 60px">
		<th>
			<a href="modifica-dati.html" style="font-size: 18px">Modifica Dati Personali</a>
		</th>
	</tr>
	<tr style="height: 60px">
		<th>
			<a href="modifica-pass.html" style="font-size: 18px">Modifica Password</a>
		</th>
	</tr>

	<tr style="height: 60px"> 
		<th>
			<a href="corsi-studente.html" style="font-size: 18px">I miei Corsi</a>
		</th>
	</tr>
	<tr style="height: 60px;">
		<th>
		<a href="ordini-studente.html" style="font-size: 18px">I miei Ordini</a>
		</th>
	</tr>
	<tr style="height: 60px;">
		<th>
		<a href="richieste-lezioni.html" style="font-size: 18px">Richieste Lezioni</a>
		</th>
	</tr>
	<tr style="height: 60px;">
		<th>
		<a href="lezioni-su-richiesta.html" style="font-size: 18px">Lezioni su richiesta acquistate</a>
		</th>
	</tr>
	<tr style="height: 60px;">
		<th>
		<a href="richieste-esercizi.html" style="font-size: 18px">Richieste Esercizi</a>
		</th>
	</tr>
	<tr style="height: 60px;">
		<th>
		<a href="esercizi-su-richiesta.html" style="font-size: 18px">Esercizi su richiesta acquistati</a>
		</th>
	</tr>

</table>

<?php
    } else {
        ?>
<table id="prev" style="width: 100%">
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<?php
    }
} else {
    ?>
<form action="amministrazione/attiva_account.php" method="post">
	<table id="prev" style="width: 100%">
		<tr>
			<td><p style="color: #0e83cd;">Attivazione Account</p></td>
		</tr>
		<tr>
			<td><input type="text" name = "codice_attivaz"  maxlength="6" size="24" autofocus="true"></td>
		</tr>
		<tr style="height: 100px">
		<td>
			<input type="submit"  value="Attiva">
		</td>
		</tr>
	</table>
</form>
<?php
}
?>