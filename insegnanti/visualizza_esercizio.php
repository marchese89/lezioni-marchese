<?php 
$id_ex = $_GET['id'];
$id_corso = $_GET['corso'];

$result = $conn->query("SELECT * FROM esercizio WHERE id='$id_ex'");
$ex = $result->fetch_assoc();
?>

<table id="pannello_controllo" >

	<tr id="titolo">
		<th>Esercizio n. <?php echo $ex['id']?>: <?php echo $ex['titolo']?></th>
	</tr>
	<tr style="height: 60px">
	<td>
	<label>Traccia</label>
	</td>
	</tr>
	<tr>
	<td>
		<iframe src="<?php echo $ex['traccia'];?>#view=FitH" width="90%" height="800px"></iframe>
	</td>
	</tr>
	<tr style="height: 60px">
	<td>
	<label>Svolgimento</label>
	</td>
	</tr>
	<tr>
	<td>
		<iframe src="<?php echo $ex['svolgimento'];?>#view=FitH" width="90%" height="800px"></iframe>
	</td>
	</tr>
	<tr>
		<td align="center" id="indietro"><strong><a
				href="corso-ins-<?php echo $id_corso;?>.html"> Indietro</a></strong></td>
		</tr>
</table>