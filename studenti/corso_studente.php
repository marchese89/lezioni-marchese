<?php
$id_corso = $_GET['id_corso'];

?>
<table align="center" id="pannello_controllo" >
	
	<?php
$studente;
if (isset($_SESSION['user'])) {
    $id_stud = trovaIdStudente($_SESSION['user'], $conn);
    if ($id_stud != -1) {
        $studente = TRUE;
    } else {
        $studente = FALSE;
    }
} else {
    $studente = FALSE;
}
$r = $conn->query("SELECT * FROM corso WHERE id='$id_corso'");
$corso = $r->fetch_assoc();

?>
	<tr id="titolo">
			<th colspan=5 style="font-size: 18px"><?php echo $corso['nome'];?>
		</th>
		</tr>
		<tr>
			<td colspan=5><label style="font-size: 18px">Lezioni</label></td>
		</tr>

		<tr style="height: 60px;">
			<td><label><b>Numero</b></label></td>
			<td><label><b>Titolo</b></label></td>
			<td><label><b>Opzioni</b></label></td>
		</tr>
		<?php
$prezzo_tot = 0;
$tot_lez = 0;

$result2 = $conn->query("SELECT * FROM lezione WHERE corso_lez = '$id_corso'");
while ($lez = $result2->fetch_assoc()) {
    if (prodotto_acquistato($id_stud, $lez['id'], 0, $conn)) { // inseriamo solo se la lezione non è stata già acquistata


        ?>
		       <tr style="height: 60px">
			<td><label style="color: black;"><?php echo $lez['numero'];?> </td>
			<td><?php echo $lez['titolo'];?></td>
			<td><button class="button" onclick=location.href="visualizza-lezione-<?php echo $id_corso;?>-<?php echo $lez['id'];?>.html">Visualizza</button>
				</label></td>

		</tr>
		       <?php
    }
}

?>

		<tr style="height: 60px">
			<td colspan=5><label style="font-size: 16px">Esercizi</label></td>
		</tr>
	<?php


    $result2 = $conn->query("SELECT * FROM esercizio WHERE corso_ex = '$id_corso'");
    while ($ex = $result2->fetch_assoc()) {
        if (prodotto_acquistato($id_stud, $ex['id'], 2, $conn)) {
            ?>
	        <tr style="height: 60px">
			<td><?php echo $ex['id']?></td>
			<td><?php echo $ex['titolo']?> </td>

			<td><?php if($studente){?> <button class="button"
					onclick=location.href="visualizza-esercizio-<?php echo $id_corso;?>-<?php echo $ex['id'];?>.html">Visualizza</button><?php }?></label></td>
			</td>
		</tr>
	        <?php
        }
    }

?>

		<tr>
			<td align="center" id="indietro" colspan="3"><strong><a
					href="corsi-studente.html"> Indietro</a></strong></td>
		</tr>
	</table>