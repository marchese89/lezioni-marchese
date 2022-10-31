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



<table id="prev" align="center">
	<tr>
		<th colspan="3" style="height: 70px" align="center"><span
			style="color: #0e83cd; font-size: 24px">Il mio profilo</span><br></th>
	</tr>
	<tr>
		<th colspan="3" align="center" style="padding-bottom: 30px">
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
	<tr>
		<th width="70" height="100"><img src="images/46.png" width="60" /></th>
		<th style="color: #0e83cd;">I Miei Dati</th>
		<th>
			<button class="button" onclick=location.href="modifica-dati.html">Modifica</button>

		</th>
	</tr>
	<tr>
		<th width="70" height="100"><img src="images/pass.png" width="60" /></th>
		<th style="color: #0e83cd;">Password</th>
		<th>
			<button class="button" onclick=location.href="modifica-pass.html">Modifica</button>
		</th>
	</tr>

	<tr>
		<th width="70" height="100"><img src="images/home5.png" width="60" />
		</th>
		<th style="color: #0e83cd;">I miei Corsi</th>
		<th>
			<button class="button" onclick=location.href="corsi-studente.html">Modifica</button>
		</th>
	</tr>
	<tr>
		<th width="70" height="100"><img src="images/555.png" width="60" /></th>
		<th width="80%" style="color: #0e83cd;">I miei Ordini</th>
		<th>
			<button class="button" onclick=location.href="ordini-utente.html">Visualizza</button>

		</th>
	</tr>
	<tr>
		<th width="70" height="100"><img src="images/75.png" width="60" /></th>
		<th width="80%" style="color: #0e83cd;">Iscrizione newsletter</th>
		<th>
			<button class="button" onclick=location.href="newsletter.html">Modifica</button>

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