<?php 
include 'config/mysql-config.php';

?>

<tr>
	<td align="center"><strong><a href="nuova-area-tematica.html"> Nuova Area Tematica</a></strong></td>
</tr>
<tr>
	<td align="center"><strong><a href="nuova-materia.html"> Nuova Materia</a></strong></td>
</tr>
<tr>
	<td align="center"><strong><a href="nuovo-corso.html"> Nuovo Corso</a></strong></td>
</tr>
<?php
$email = $_SESSION['user'];
$result = $conn->query("SELECT * FROM utente WHERE email='$email'");
$utente = $result->fetch_assoc();
$id_utente = $utente['id'];
$result = $conn->query("SELECT * FROM insegnante WHERE utente_i='$id_utente'");
$insegnante = $result->fetch_assoc();
$id_insegnante = $insegnante['id'];
$result = $conn->query("SELECT * FROM lezione WHERE insegnante='$id_insegnante'");
$elenco_corsi = [];
while ($row = $result->fetch_assoc()) {
    
}
?>
<tr>
	<td align="center"><strong><a href="elenco-corsi.html"> Elenco
				corsi/lezioni inserite</a></strong></td>
</tr>
<tr>
			<td align="center"><strong><a
					href="corsi-insegnante.html">
					Indietro</a></strong></td>
		</tr>