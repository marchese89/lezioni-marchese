<?php
include 'config/mysql-config.php';

$id_corso = $_GET['id_corso'];
?>
<table align="center" width="100%" id="pannello_controllo" cellspacing=0
	cellpadding=0>

	<tr id="titolo">
		<th>Corsi</th>
	</tr>
	<tr style="height: 60px">
		<td><label>Lezioni</label></td>
	</tr>
		<?php
$result = $conn->query("SELECT * FROM argomento WHERE corso_arg='$id_corso'");
while ($argomento = $result->fetch_assoc()) {
    $id_arg = $argomento['id'];
    ?>
		   <tr style="height: 60px">
		<td><label>Argomento: <?php echo $argomento['nome']?></label></td>
	</tr>
		   <?php
    $result2 = $conn->query("SELECT * FROM lezione WHERE arg_lez='$id_arg'");
    while ($lez = $result2->fetch_assoc()) {
        $id_ins = $lez['insegnante'];
        $result3 = $conn->query("SELECT * FROM insegnante WHERE id='$id_ins'");
        $ins = $result3->fetch_assoc();
        $id_ut = $ins['utente_i'];
        $result4 = $conn->query("SELECT * FROM utente WHERE id='$id_ut'");
        $utente = $result4->fetch_assoc();
        ?>
		       <tr style="height: 60px">
		<td><label>(<?php echo $lez['numero'];?>) - <?php echo $lez['titolo'];
		?> - insegnante: <?php echo $utente['nome'] . " ". $utente['cognome'];?> - prezzo: <?php echo $lez['prezzo'];?>&euro;</label>
		</td>
	</tr>
		       <?php
    }
}
?>
		<tr style="height: 60px">
		<td><label>Esercizi</label></td>
	</tr>
	<tr>
		<td align="center" id="indietro"><strong><a href="aree-tematiche.html">
					Indietro</a></strong></td>
	</tr>
</table>