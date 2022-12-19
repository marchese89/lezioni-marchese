<?php
if (! $conn) {
    header("Location: ../index.html");
}
$email;
if (isset($_SESSION['user'])) {
    $email = $_SESSION['user'];
}

$result = $conn->query("SELECT * FROM utente WHERE email='$email'");
$utente;
if ($result->num_rows > 0) {
    $utente = $result->fetch_assoc();
}
if ($utente['stato_account'] === '1') {
    if (isset($_SESSION['user'])) {

        ?>



<table id="pannello_controllo" >

	<tr id="titolo">
		<th colspan="3" style="height: 70px" align="center"><span
			style="color: #0e83cd; font-size: 24px">Il mio profilo <?php echo $utente['nome'] . " ". $utente['cognome'];?>  (insegnante)</span><br>
		</th>
	</tr>
	<tr style="height: 60px">
		<td align="center" style="">
            <?php

        $data = $_SESSION['last_login'];
        $anno = substr($data, 0, 4);
        $mese = substr($data, 5, 2);
        $giorno = substr($data, 8, 2);
        $ora = substr($data, 11, 5);
        ?>
                            <span
			style="font-size: 14px; color: #0e83cd;">(Ultimo accesso: <?php echo $giorno . '/' . $mese . '/' . $anno . ' ore '. $ora;?>)</span>

		</td>
	</tr>

	<tr style="height: 60px">
		<td><a href="modifica-dati-insegnante.html" style="font-size: 18px">Modifica Dati
				Personali</a></td>
	</tr>
	<tr style="height: 60px">
		<td><a href="modifica-pass-insegnante.html" style="font-size: 18px">Modifica
				Password</a></td>
	</tr>
	<tr style="height: 60px">
		<td>
		<a href="corsi.html" style="font-size: 18px">Corsi</a>
		</td>
	</tr>
	<tr style="height: 60px">
		<td><a href="lezioni-richieste.html">Richieste Studenti</a></td>
	</tr>
	<tr style="height: 60px">
		<td><a href="chat-studenti.html">Chat Studenti</a></td>
	</tr>
	<tr style="height: 60px">
		<td>
		<a href="vendite-insegnante.html" style="font-size: 18px">Vendite</a>
		</td>
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
	<input type="hidden" name="aut" value="ins" >
	<table id="prev" style="width: 100%">
		<tr>
			<td><p style="color: #0e83cd;">Attivazione Account</p></td>
		</tr>
		<tr>
			<td><input type="text" name="codice_attivaz" maxlength="6" size="24"
				autofocus="true"></td>
		</tr>
		<tr style="height: 100px">
			<td><input type="submit" value="Attiva"></td>
		</tr>
	</table>
</form>
<?php
}
?>