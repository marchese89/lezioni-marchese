<?php 
$id_ordine = $_GET['id'];
$result = $conn->query("SELECT * FROM ordine WHERE id = '$id_ordine'");
$ordine = $result->fetch_assoc();
?>
<table align="center" width="100%" id="pannello_controllo" cellspacing=0
	cellpadding=0>

	<tr id="titolo">
		<th colspan="3" >Visualizza Fattura</th>
	</tr>
<tr>
<tr>
	<td>
	<iframe src="<?php echo $ordine['fattura'];?>#view=FitH" width="90%" height="800px"></iframe>
	</td>
	</tr>
		<td align="center" id="indietro" colspan="3"><strong><a href="ordini-studente.html">
					Indietro</a></strong></td>
	</tr>
</table>