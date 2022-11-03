<?php
include 'config/mysql-config.php';

$id_mat = $_GET['id_mat'];
?>
<table align="center" width="100%" id="pannello_controllo" cellspacing=0 cellpadding=0>
	
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
			<td align="center" id="indietro"><strong><a
					href="aree-tematiche.html">
					Indietro</a></strong></td>
		</tr>
</table>