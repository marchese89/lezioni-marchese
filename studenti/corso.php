<?php
include 'config/mysql-config.php';

$id_corso = $_GET['id_corso'];
?>
<table align="center" width="100%" id="pannello_controllo" cellspacing=0
	cellpadding=0>

	<tr id="titolo">
		<th>Corsi</th>
	</tr>
	<table border=0 width=60% align=center cellpadding="0" cellspacing="0">
	<?php 
	$r = $conn->query("SELECT * FROM corso WHERE id='$id_corso'");
	$corso = $r->fetch_assoc();
	?>
	<tr style="height: 60px">
		<td colspan=6 style="font-size: 18px"> Corso: "<?php echo $corso['nome'];?>"
		</td>
	</tr>
	<tr style="height: 60px">
	
		<td colspan=6><label style="font-size: 18px">Lezioni</label></td>
	</tr>
	
	
	<tr style="height: 60px;">
	<td><label><b>Numero</b></label></td>
	<td><label><b>Titolo</b></label></td>
	<td><label><b>Argomento</b></label></td>
	<td><label><b>Insegnante</b></label></td>
	<td><label><b>Prezzo</b></label></td>
	<td><label><b>Opzioni</b></label></td>
	</tr>
		<?php
		$prezzo_tot = 0;
		$tot_lez = 0;
$result = $conn->query("SELECT * FROM argomento WHERE corso_arg='$id_corso'");
while ($argomento = $result->fetch_assoc()) {
    $id_arg = $argomento['id'];
    ?>
		 
	
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
		<td><label style="color: black;"><?php echo $lez['numero'];?> </td><td> <?php echo $lez['titolo'];
		?> </td><td><?php echo $argomento['nome'];?></td><td><?php echo $utente['nome'] . " ". $utente['cognome'];?> </td><td><?php echo $lez['prezzo'];$prezzo_tot = $prezzo_tot+$lez['prezzo']; $tot_lez = $tot_lez+$lez['prezzo'];?>&euro; </td><td> <button class="button" onclick=location.href="acquisti/aggiungi_al_carrello.php?tipo=lez&id=<?php echo $lez['id'];?>">Acquista</button></label></td>
		
	</tr>
		       <?php
    }
}
?>
<tr style="height: 60px" >
		<td colspan=5><label style="font-size: 16px">Acquista tutte le lezioni  (<?php echo $tot_lez;?> &euro;)  </label></td><td><button class="button" onclick=location.href="acquisti/aggiungi_al_carrello.php?tipo=corso&id=<?php echo $id_corso;?>">Acquista</button></td>
	</tr>


		<tr style="height: 60px">
		<td colspan=5><label style="font-size: 16px">Esercizi</label></td>
	</tr>
	<?php 
	$tot_ex = 0;
	$result = $conn->query("SELECT * FROM argomento WHERE corso_arg='$id_corso'");
	while ($argomento = $result->fetch_assoc()) {
	    $id_arg = $argomento['id'];
	    $result2 = $conn->query("SELECT * FROM esercizio WHERE argomento='$id_arg'");
	    while ($ex = $result2->fetch_assoc()) {
	        $id_ins = $ex['insegn'];
	        $result3 = $conn->query("SELECT * FROM insegnante WHERE id='$id_ins'");
	        $ins = $result3->fetch_assoc();
	        $id_ut = $ins['utente_i'];
	        $result4 = $conn->query("SELECT * FROM utente WHERE id='$id_ut'");
	        $utente = $result4->fetch_assoc();
	        ?>
	        <tr style="height: 60px">
	        <td></td>
	        <td>
	        <label style="color: black;"><?php echo $ex['titolo']?> </td><td><?php echo $argomento['nome']?></td><td><?php echo $utente['nome'] . " ". $utente['cognome'];?> </td><td><?php echo $ex['prezzo'];$prezzo_tot = $prezzo_tot+$ex['prezzo'];$tot_ex = $tot_ex + $ex['prezzo'];?>&euro;</td>
	        <td> <button class="button" onclick=location.href="acquisti/aggiungi_al_carrello.php?tipo=ex&id=<?php echo $ex['id'];?>">Acquista</button></label></td>
	        </td>
	        </tr>
	        <?php 
	    }
	}
	?>
	<tr>
	<tr style="height: 60px">
		<td colspan=5>
		<label style="font-size: 16px">Acquista tutti gli esercizi  (<?php echo $tot_ex;?> &euro;)  </label></td><td><button class="button" onclick=location.href="acquisti/aggiungi_al_carrello.php?tipo=all_ex&id=<?php echo $id_corso;?>">Acquista</button>
		</td>
	</tr>
	<tr style="height: 60px">
		<td colspan=5>
		<label style="font-size: 16px">Acquista tutte le lezioni e tutti gli esercizi  (<?php echo $prezzo_tot;?> &euro;)  </label></td><td><button class="button" onclick=location.href="acquisti/aggiungi_al_carrello.php?tipo=all&id=<?php echo $id_corso;?>">Acquista</button>
		</td>
	</tr>
	</table>
	<table width=100% align=center>
	<?php 
	$result2 = $conn->query("SELECT * FROM corso WHERE id='$id_corso'");
	$corso = $result2->fetch_assoc();
	$mat = $corso['materia'];
	?>
		<td align="center" id="indietro"><strong><a href="corsi-<?php echo $mat;?>.html">
					Indietro</a></strong></td>
	</tr>
</table>