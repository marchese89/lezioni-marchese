<?php 
$id_lezione = $_GET['id'];
$result = $conn->query("SELECT * FROM richieste_lezioni WHERE id = '$id_lezione'");
$richiesta = $result->fetch_assoc();

$id_studente = trovaIdStudente($_SESSION['user'],$conn);
$result = $conn->query("SELECT * FROM richieste_lezioni WHERE id = '$id_lezione'");
$richiesta = $result->fetch_assoc();
?>

<table align="center" width="100%" id="pannello_controllo" cellspacing=0
	cellpadding=0 >

	<tr id="titolo">
		<th colspan=4>Lezione su Richiesta: <?php echo  $richiesta['titolo'];?></th>
	</tr>
	<tr style="height: 60px">
	<td><label>Traccia</label></td>

	       </tr>
	<tr style="height: 60px">
	       <td>
	       <iframe src="<?php echo $richiesta['traccia'];?>#view=FitH" width="90%" height="800px"></iframe>
	       </td>
	       </tr>
	<tr style="height: 60px">
	<td><label>Svolgimento</label></td>

	       </tr>

       
	       <tr style="height: 60px">
	       <td>
	       <iframe src="<?php echo $richiesta['svolgimento'];?>#view=FitH" width="90%" height="800px"></iframe>
	       </td>
	       </tr>
	      
	<tr>

			<td align="center" id="indietro" colspan=4><strong><a
					href="lezioni-su-richiesta-acquistate.html">
					Indietro</a></strong></td>
		</tr>
</table>