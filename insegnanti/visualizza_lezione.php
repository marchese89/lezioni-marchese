<?php
$id_lez = $_GET['id'];
$id_corso = $_GET['corso'];
$id_stud = trovaIdStudente($_SESSION['user'], $conn);
$result = $conn->query("SELECT * FROM lezione WHERE id='$id_lez'");
$lez = $result->fetch_assoc();
?>

<table align="center" width="100%" id="pannello_controllo" cellspacing=0
	cellpadding=0 rules=all border=1>

	<tr id="titolo">
		<th>Lezione n. <?php echo $lez['numero']?></th>
	</tr>
	<tr style="height: 60px">
		<td><label><?php echo $lez['titolo']?></label></td>
	</tr>
	<tr style="height: 60px">
		<td><label>Presentazione</label></td>
	</tr>
	<tr>
		<td><iframe src="<?php echo $lez['presentazione'];?>#view=FitH"
				width="90%" height="800px"></iframe></td>
	</tr>
	<tr style="height: 60px">
		<td><label>Lezione</label></td>
	</tr>
	<tr>
		<td><iframe src="<?php echo $lez['lezione'];?>#view=FitH" width="90%"
				height="800px"></iframe></td>
	</tr>
		
	<tr>
		<td align="center" id="indietro"><strong><a
				href="corso-ins-<?php echo $id_corso;?>.html">Indietro</a></strong></td>
	</tr>
</table>