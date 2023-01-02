<?php 
$at = $_GET['at'];
?>
<table id="pannello_controllo">
	<tr id="titolo"><th colspan="5">Materia</th></tr>
	<?php 
	$result = $conn->query("SELECT * FROM materia WHERE area_tematica = '$at'");
	while($mat = $result->fetch_assoc()){
	   
	    ?>
	    <tr>
	    <td><a href="richiesta_lezione4-<?php echo $mat['id'];?>-<?php echo $at;?>.html"><?php echo $mat['nome'];?></a></td>
	    </tr>
	    <?php 
	}
	?>
	<tr>
			<td align="center" id="indietro"><strong><a
					href="richiesta_lezione2.html">
					Indietro</a></strong></td>
		</tr>
</table>