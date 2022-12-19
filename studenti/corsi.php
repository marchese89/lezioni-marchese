<?php
include 'config/mysql-config.php';

$id_mat = $_GET['id_mat'];
?>
<table align="center" id="pannello_controllo" cellspacing=0 cellpadding=0>
	
		<tr id="titolo">
			<th>Corsi</th>
		</tr>
		<?php 
		$result = $conn->query("SELECT * FROM corso WHERE materia='$id_mat'");
		while($corso = $result->fetch_assoc()){
		   ?>
		   <tr><td>
		   <a href="corso-<?php echo $corso['id'];?>.html"><?php echo $corso['nome']?></a>
		   </td>
		   </tr>
		   <?php
		}
		?>

		<tr>
		<?php 
		$result2 = $conn->query("SELECT * FROM materia WHERE id='$id_mat'");
		$materia = $result2->fetch_assoc();
		$a_t = $materia['area_tematica'];
		?>
			<td align="center" id="indietro"><strong><a
					href="materie-<?php echo $a_t;?>.html">
					Indietro</a></strong></td>
		</tr>
</table>