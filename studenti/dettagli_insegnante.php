<?php
$mat = $_GET['mat'];
$at = $_GET['at'];
$id_ins = $_GET['id_ins'];
?>
<table id="pannello_controllo">
	<tr id="titolo">
		<th colspan="5">Dettagli Insegnante</th>
	</tr>

	<?php
$result = $conn->query("SELECT * FROM insegnante WHERE id = '$id_ins'");
$insegnante = $result->fetch_assoc();
$id_ut = $insegnante['utente_i'];
$r2 = $conn->query("SELECT * FROM utente WHERE id = '$id_ut'");
$utente = $r2->fetch_assoc();
?>
	    <tr>
		<td><label>Nome e Cognome</label></td>
	</tr>
	<tr>
		<td><?php echo $utente['nome']. " " . $utente['cognome'];?></td>
	</tr>
	<tr>
		<td><label>Foto</label></td>
	</tr>
	<tr>
		<td><img src="<?php echo $insegnante['foto'];?>" height="250"
			width="250"></td>
	</tr>
	<tr>
		<td><label>Curriculum Vitae</label></td>
	</tr>
	<tr>
		<td><iframe src="<?php echo $insegnante['cv'];?>#view=FitH"
				style="width: 90%; height: 800px"></iframe></td>
	</tr>
	<tr>
		<td><label style="font-size: 16px">Recensioni</label></td>
	</tr>
	
		<?php
$r3 = $conn->query("SELECT * FROM feedback");
while ($feed = $r3->fetch_assoc()) {
    $id_insegnante = trovaIdInsegnanteDaProdotto($feed['prodotto'], $feed['tipo_prodotto'], $conn);
    if ($id_ins == $id_insegnante) {
        if ($feed['recensione'] != NULL && $feed['recensione'] != "") {
            $id_stud = $feed['studente'];
            $r4 = $conn->query("SELECT * FROM studente WHERE id= '$id_stud'");
            $studente = $r4->fetch_assoc();
            $id_utente = $studente['utente_s'];
            $r5 = $conn->query("SELECT * FROM utente WHERE id = '$id_utente'");
            $utente = $r5->fetch_assoc();
            ?>
            <tr><td><label>Recensione di <?php echo $utente['nome'] . " " . $utente['cognome'];?></label></td></tr>
            <tr><td>
            <?php 
            echo $feed['recensione'];
            ?>
            </td>
            </tr>
            <?php 
        }
    }
}
?>
	    
<tr>
<td><button onclick=location.href="richiesta_lezione5-<?php echo $id_ins?>-<?php echo $mat;?>-<?php echo $at;?>.html">Scegli Insegnante</button></td>
</tr>

	<tr>
		<td align="center" id="indietro" colspan="5"><strong><a
				href="richiesta_lezione4-<?php echo $mat;?>-<?php echo $at;?>.html">
					Indietro</a></strong></td>
	</tr>
</table>