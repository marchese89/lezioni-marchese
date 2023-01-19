<?php 
$numero = $_GET['n'];
?>
<table id="pannello_controllo">
	<tr id="titolo">
		<th valign="center" height="100"
			style="font-size: 24px; color: #0e83cd;" colspan="3">Fattura n. <?php echo $numero;?></th>
	</tr>
	<tr><td>Si prega di scaricare la fattura, perchè non sarà più possibile visualizzarla</td></tr>
	<tr>
	<td>
	<?php 
	$res = $conn->query("SELECT * FROM fatture  WHERE numero = '$numero'");
	$fattura = $res->fetch_assoc();
	?>
	<iframe src="<?php echo $fattura['percorso'];?>#view=FitH" width="90%" height="800px"></iframe>
	</td>
	</tr>
</table>