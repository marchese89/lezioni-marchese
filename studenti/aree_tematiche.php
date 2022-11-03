<?php
include 'config/mysql-config.php';

?>
<table align="center" width="100%" id="pannello_controllo" cellspacing=0 cellpadding=0>
	
		<tr id="titolo">
			<th>Aree Tematiche</th>
		</tr>
		<?php 
		$result = $conn->query("SELECT * FROM area_tematica");
		while($at = $result->fetch_assoc()){
		   ?>
		   <tr><td>
		   <a href="materie-<?php echo $at['id'];?>.html"><?php echo $at['nome']?></a>
		   </td>
		   </tr>
		   <?php
		}
		?>

		<tr>
			<td align="center" id="indietro"><strong><a
					href="index.php">
					Indietro</a></strong></td>
		</tr>
</table>	