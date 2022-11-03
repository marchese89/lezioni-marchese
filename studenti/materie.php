<?php
include 'config/mysql-config.php';

$id_at = $_GET['id_at'];
?>
<table align="center" width="100%" id="pannello_controllo" cellspacing=0 cellpadding=0>
	
		<tr id="titolo">
			<th>Materie</th>
		</tr>
		<?php 
		$result = $conn->query("SELECT * FROM materia WHERE area_tematica='$id_at'");
		while($mat = $result->fetch_assoc()){
		   ?>
		   <tr><td>
		   <a href="corsi-<?php echo $mat['id'];?>.html"><?php echo $mat['nome']?></a>
		   </td>
		   </tr>
		   <?php
		}
		?>

		<tr>
			<td align="center" id="indietro"><strong><a
					href="aree-tematiche.html">
					Indietro</a></strong></td>
		</tr>
</table>