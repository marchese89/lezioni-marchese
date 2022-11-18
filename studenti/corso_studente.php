<?php


$id_corso = $_GET['id_corso'];

?>
<table align="center" width="100%" id="pannello_controllo" cellspacing=0
	cellpadding=0>

	<tr id="titolo">
		<th>Corsi</th>
	</tr>
	<table border=0 width=60% align=center cellpadding="0" cellspacing="0">
	
	<?php
$studente;
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    $r1 = $conn->query("SELECT * FROM utente WHERE email='$user'");
    $ut = $r1->fetch_assoc();
    $id = $ut['id'];
    $r2 = $conn->query("SELECT * FROM studente WHERE utente_s='$id'");
    $id_stud;
    if ($r2->num_rows > 0) {
        $st = $r2->fetch_assoc();
        $id_stud = $st['id'];
        $studente = TRUE;
    } else {
        $studente = FALSE;
    }
} else {
    $studente = FALSE;
}
$r = $conn->query("SELECT * FROM corso WHERE id='$id_corso'");
$corso = $r->fetch_assoc();
if (! $studente) {
    ?>
	    <tr style="height: 60px">
			<td colspan=6 style="font-size: 18px; color: red">Accedi come
				studente se vuoi fare acquisti!</td>
		</tr>
	    <?php
}
?>
	<tr style="height: 60px">
			<td colspan=5 style="font-size: 18px"> Corso: "<?php echo $corso['nome'];?>"
		</td>
		</tr>
		<tr style="height: 60px">

			<td colspan=5><label style="font-size: 18px">Lezioni</label></td>
		</tr>

		<tr style="height: 60px;">
			<td><label><b>Numero</b></label></td>
			<td><label><b>Titolo</b></label></td>
			<td><label><b>Argomento</b></label></td>
			<td><label><b>Insegnante</b></label></td>
			<td><label><b>Opzioni</b></label></td>
		</tr>
		<?php
$prezzo_tot = 0;
$tot_lez = 0;
$result = $conn->query("SELECT * FROM argomento WHERE corso_arg='$id_corso'");
while ($argomento = $result->fetch_assoc()) {
    $id_arg = $argomento['id'];
    $result2 = $conn->query("SELECT * FROM lezione WHERE arg_lez='$id_arg'");
    while ($lez = $result2->fetch_assoc()) {
        if (prodotto_acquistato($id_stud, $lez['id'], 0, $conn)) { // inseriamo solo se la lezione non è stata già acquistata
            $id_ins = $lez['insegnante'];
            $result3 = $conn->query("SELECT * FROM insegnante WHERE id='$id_ins'");
            $ins = $result3->fetch_assoc();
            $id_ut = $ins['utente_i'];
            $result4 = $conn->query("SELECT * FROM utente WHERE id='$id_ut'");
            $utente = $result4->fetch_assoc();
            ?>
		       <tr style="height: 60px">
			<td><label style="color: black;"><?php echo $lez['numero'];?> </td>
			<td><?php echo $lez['titolo'];?></td>
			<td><?php echo $argomento['nome'];?></td>
			<td><?php echo $utente['nome'] . " ". $utente['cognome'];?> </td>
			
			<td><button class="button"
					onclick=location.href="visualizza-lezione-<?php echo $id_corso;?>-<?php echo $lez['id'];?>.html">Visualizza</button></label></td>

		</tr>
		       <?php
        }
    }
}
?>

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
        if (prodotto_acquistato($id_stud, $ex['id'], 2, $conn)) {
        ?>
	        <tr style="height: 60px">
			<td></td>
			<td><label style="color: black;"></label><?php echo $ex['titolo']?> </td>
			<td><?php echo $argomento['nome']?></td>
			<td><?php echo $utente['nome'] . " ". $utente['cognome'];?> </td>
			<td><?php if($studente){?> <button class="button"
					onclick=location.href="visualizza-esercizio-<?php echo $id_corso;?>-<?php echo $ex['id'];?>.html">Visualizza</button><?php }?></label></td>
			</td>
		</tr>
	        <?php
        }
    
    }
}
?>
		

	</table>
	<table width=100% align=center>	
	<tr>
		<td align="center" id="indietro"><strong><a
				href="corsi-studente.html"> Indietro</a></strong></td>
		</tr>
	</table>