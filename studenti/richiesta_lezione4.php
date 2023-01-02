<?php 
$mat = $_GET['mat'];
$at = $_GET['at'];

?>
<table id="pannello_controllo">
	<tr id="titolo"><th colspan="5">Corso</th></tr>
	<tr>
	<td><label>Nome Corso</label></td>
	<td><label>Insegnante</label></td>
	<td><label>Media Valutazioni</label></td>
	<td><label>Opzioni</label></td>
	</tr>
	<?php 
	$result = $conn->query("SELECT * FROM corso WHERE materia = '$mat'");
	while($cor = $result->fetch_assoc()){
	   
	    ?>
	    <tr>
	    <td><?php echo $cor['nome'];?></td>
	    <?php 
	    $ins = $cor['insegnante'];
	    $r1 = $conn->query("SELECT * FROM insegnante WHERE id = '$ins'");
	    $insegnante = $r1->fetch_assoc();
	    $id_ut = $insegnante['utente_i'];
	    $r2 = $conn->query("SELECT * FROM utente WHERE id = '$id_ut'");
	    $utente = $r2->fetch_assoc();
	    ?>
	    <td><?php echo $utente['nome'] . $utente['cognome'];?></td>
	    <td>
	    <?php 
	    $punteggio =  number_format(punteggioInsegnante($cor['id'], $conn),0);
	    for($i = 0; $i < $punteggio; $i++){
	    echo '⭐';
	    }
	    echo " (" . number_format(punteggioInsegnante($cor['id'], $conn),2) . ")";
	    ?></td>
	    <td><button onclick=location.href="dettagli-insegnante-<?php echo $ins;?>-<?php echo $mat;?>-<?php echo $at;?>.html">Dettagli</button></td>
	    </tr>
	    <?php 
	}
	?>
	<tr>
			<td align="center" id="indietro" colspan="5"><strong><a
					href="richiesta_lezione3-<?php echo $at;?>.html">
					Indietro</a></strong></td>
		</tr>
</table>