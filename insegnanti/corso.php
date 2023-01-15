<?php


$id_corso = $_GET['id_corso'];

$r = $conn->query("SELECT * FROM corso WHERE id='$id_corso'");
$corso = $r->fetch_assoc();


?>
<table   id="pannello_controllo" >

	<tr id="titolo">
		<th colspan=4>Corso di&nbsp;"<?php echo $corso['nome'];?>"</th>
	</tr>
	
		<tr>

			<td colspan=4><label style="font-size: 18px">Lezioni</label></td>
		</tr>
		<tr>
			<td colspan=4><button onclick=location.href="nuova-lezione-<?php echo $id_corso;?>.html">Nuova Lezione</button></td>
		</tr>


		<tr>
			<td><label><b>Numero</b></label></td>
			<td><label><b>Titolo</b></label></td>
			<td><label><b>Prezzo</b></label></td>
			<td><label><b>Operazioni</b></label></td>
		</tr>
		<?php
$prezzo_tot = 0;
$tot_lez = 0;
$result = $conn->query("SELECT * FROM lezione WHERE corso_lez='$id_corso'");
while ($lez = $result->fetch_assoc()) {

       
            
            ?>
		       <tr>
			<td><?php echo $lez['numero'];?> </td>
			<td><?php echo $lez['titolo'];?></td>
			<td><?php echo $lez['prezzo'];$prezzo_tot = $prezzo_tot+$lez['prezzo']; $tot_lez = $tot_lez+$lez['prezzo'];?>&euro; </td>
			<td><button class="button" onclick=location.href="visualizza-lezione-ins-<?php echo $id_corso;?>-<?php echo $lez['id'];?>.html">Visualizza</button>
			<button class="button" onclick=location.href="modifica-lezione-<?php echo $id_corso;?>-<?php echo $lez['id'];?>.html">Modifica</button>
			</td>
		</tr>
		       <?php
       
    
}

?>


		<tr style="height: 60px">
			<td colspan=4><label style="font-size: 16px">Esercizi</label></td>
		</tr>
		<tr>
			<td colspan=4><button onclick=location.href="nuovo-esercizio-<?php echo $id_corso;?>.html">Nuovo Esercizio</button></td>
		</tr>
	<?php
$tot_ex = 0;
$result = $conn->query("SELECT * FROM esercizio WHERE corso_ex='$id_corso'");
while ($ex = $result->fetch_assoc()) {
        
        ?>
	        <tr style="height: 60px">
			<td></td>
			<td><label style="color: black;"></label><?php echo $ex['titolo']?> </td>
			<td><?php echo $ex['prezzo'];$prezzo_tot = $prezzo_tot+$ex['prezzo'];$tot_ex = $tot_ex + $ex['prezzo'];?>&euro;</td>
			<td>
			<button class="button" onclick=location.href="visualizza-esercizio-ins-<?php echo $id_corso;?>-<?php echo $ex['id'];?>.html" >Visualizza</button>
			<button class="button" onclick=location.href="modifica-esercizio-ins-<?php echo $id_corso;?>-<?php echo $ex['id'];?>.html" >Modifica</button>
			</td>
			
		</tr>
    
    <?php 
}

?>

	   <tr>
		<td colspan="4" id="indietro"><strong><a
				href="elenco-corsi.html"> Indietro</a></strong></td>
		</tr>
	</table>
	