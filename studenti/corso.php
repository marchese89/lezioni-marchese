<?php


$id_corso = $_GET['id_corso'];

$r = $conn->query("SELECT * FROM corso WHERE id='$id_corso'");
$corso = $r->fetch_assoc();

$id_ins = $corso['insegnante'];
$result3 = $conn->query("SELECT * FROM insegnante WHERE id='$id_ins'");
$ins = $result3->fetch_assoc();
$id_ut = $ins['utente_i'];
$result4 = $conn->query("SELECT * FROM utente WHERE id='$id_ut'");
$utente = $result4->fetch_assoc();

?>
<table align="center" width="100%" id="pannello_controllo" cellspacing=0 cellpadding=0>

	<tr id="titolo">
		<th colspan=4>Corsi</th>
	</tr>
	
	<?php
$studente;
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    if (studente($user,$conn)) {
        $id_stud = trovaIdStudente($user,$conn);
        $studente = TRUE;
    } else {
        $studente = FALSE;
    }
} else {
    $studente = FALSE;
}

if (! $studente) {
    ?>
	    <tr style="height: 60px">
			<td colspan=4 style="font-size: 18px; color: red">Accedi come
				studente se vuoi fare acquisti!</td>
		</tr>
	    <?php
}
?>
	<tr style="height: 60px">
			<td colspan=4 style="font-size: 18px"> Corso: "<?php echo $corso['nome'];?>" di <?php echo $utente['nome'] . " " . $utente['cognome'];?>
		</td>
		</tr>
		<tr style="height: 60px">

			<td colspan=4><label style="font-size: 18px">Lezioni</label></td>
		</tr>


		<tr style="height: 60px;">
			<td><label><b>Numero</b></label></td>
			<td><label><b>Titolo</b></label></td>
			<td><label><b>Prezzo</b></label></td>
			<td><label><b>Opzioni</b></label></td>
		</tr>
		<?php
$prezzo_tot = 0;
$tot_lez = 0;
$result = $conn->query("SELECT * FROM lezione WHERE corso_lez='$id_corso'");
while ($lez = $result->fetch_assoc()) {

        if ($studente && !prodotto_acquistato($id_stud, $lez['id'], 0, $conn)) { // inseriamo solo se la lezione non è stata già acquistata
            
            ?>
		       <tr style="height: 60px">
		       <label style="color: black;">
			<td><?php echo $lez['numero'];?> </td>
			<td><?php echo $lez['titolo'];?></td>
			<td><?php echo $lez['prezzo'];$prezzo_tot = $prezzo_tot+$lez['prezzo']; $tot_lez = $tot_lez+$lez['prezzo'];?>&euro; </td>
			<td><button class="button" onclick=location.href="visualizza-presentazione-lezione-<?php echo $id_corso;?>-<?php echo $lez['id'];?>.html">Visualizza Presentazione</button>
			<?php if($studente){?> <button class="button"
					onclick=location.href="acquisti/aggiungi_al_carrello.php?tipo=lez&id=<?php echo $lez['id'];?>">Acquista</button><?php }?></label></td>

		</tr>
		       <?php
        } else if(!$studente){
                        
            ?>
		    <tr style="height: 60px">
		    <label style="color: black;">
				<td><?php echo $lez['numero'];?> </td>
				<td><?php echo $lez['titolo'];?></td>
				<td><?php echo $lez['prezzo'];$prezzo_tot = $prezzo_tot+$lez['prezzo']; $tot_lez = $tot_lez+$lez['prezzo'];?>&euro; </td>
				<td><button class="button" onclick=location.href="visualizza-presentazione-lezione-<?php echo $id_corso;?>-<?php echo $lez['id'];?>.html">Visualizza Presentazione</button>
				<?php if($studente){?> <button class="button" onclick=location.href="acquisti/aggiungi_al_carrello.php?tipo=lez&id=<?php echo $lez['id'];?>">Acquista</button><?php }?></label></td>
			</tr>
          <?php 
            
        }
    
}
if($tot_lez > 0){
?>

<tr style="height: 60px">
			<td colspan=3 align="right"><label style="font-size: 16px">Acquista tutte le lezioni  (<?php echo $tot_lez;?> &euro;)  </label></td>
			<td><?php if($studente){?><button class="button"
					onclick=location.href="acquisti/aggiungi_al_carrello.php?tipo=corso&id=<?php echo $id_corso;?>">Acquista</button><?php }?></td>
		</tr>
<?php 
}
?>

		<tr style="height: 60px">
			<td colspan=4><label style="font-size: 16px">Esercizi</label></td>
		</tr>
	<?php
$tot_ex = 0;
$result = $conn->query("SELECT * FROM esercizio WHERE corso_ex='$id_corso'");
while ($ex = $result->fetch_assoc()) {
        if ($studente && !prodotto_acquistato($id_stud, $ex['id'], 2, $conn)) {
        ?>
	        <tr style="height: 60px">
			<td></td>
			<td><label style="color: black;"></label><?php echo $ex['titolo']?> </td>
			<td><?php echo $ex['prezzo'];$prezzo_tot = $prezzo_tot+$ex['prezzo'];$tot_ex = $tot_ex + $ex['prezzo'];?>&euro;</td>
			<td><button class="button" onclick=location.href="visualizza-traccia-esercizio-<?php echo $id_corso;?>-<?php echo $ex['id'];?>.html" >Visualizza Traccia</button>
			<?php if($studente){?> <button class="button"
					onclick=location.href="acquisti/aggiungi_al_carrello.php?tipo=ex&id=<?php echo $ex['id'];?>">Acquista</button><?php }?></label></td>
			</td>
		</tr>
	        <?php
        }else if(!$studente){
            ?>
            <tr style="height: 60px">
			<td></td>
			<td><label style="color: black;"></label><?php echo $ex['titolo']?> </td>
			<td><?php echo $ex['prezzo'];$prezzo_tot = $prezzo_tot+$ex['prezzo'];$tot_ex = $tot_ex + $ex['prezzo'];?>&euro;</td>
			<td><button class="button" onclick=location.href="visualizza-traccia-esercizio-<?php echo $id_corso;?>-<?php echo $ex['id'];?>.html">Visualizza Traccia</button>
			<?php if($studente){?> <button class="button"
					onclick=location.href="acquisti/aggiungi_al_carrello.php?tipo=ex&id=<?php echo $ex['id'];?>">Acquista</button><?php }?></label></td>
			</td>
		</tr>
        <?php
        
    
    }
}
if($tot_ex > 0){
?>
	<tr>
		
		
		<tr style="height: 60px">
			<td colspan=3 align="right"><label style="font-size: 16px">Acquista tutti gli esercizi  (<?php echo $tot_ex;?> &euro;)  </label></td>
			<td><?php if($studente){?><button class="button"
					onclick=location.href="acquisti/aggiungi_al_carrello.php?tipo=all_ex&id=<?php echo $id_corso;?>">Acquista</button><?php }?>
		
		</td>
		</tr>
		<?php 
        }
        if($tot_lez > 0 || $tot_ex > 0){
		?>
		<tr style="height: 60px">
			<td colspan=3 align="right"><label style="font-size: 16px">Acquista tutte le lezioni e tutti gli esercizi  (<?php echo $prezzo_tot;?> &euro;)  </label></td>
			<td><?php if($studente){?><button class="button"
					onclick=location.href="acquisti/aggiungi_al_carrello.php?tipo=all&id=<?php echo $id_corso;?>">Acquista</button><?php }?>
		</td>
		</tr>
		<?php 
        }
		?>
	</table>
	<table width=100% align=center>
	<?php
$result2 = $conn->query("SELECT * FROM corso WHERE id='$id_corso'");
$corso = $result2->fetch_assoc();
$mat = $corso['materia'];
?>
		<td align="center" id="indietro"><strong><a
				href="corsi-<?php echo $mat;?>.html"> Indietro</a></strong></td>
		</tr>
	</table>
	