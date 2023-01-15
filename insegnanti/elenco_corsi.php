
<table id="pannello_controllo" >
	<tr id="titolo">
		<th colspan="4">Elenco Corsi
		</th>
	</tr>
	<td><label>Area Tematica</label></td>
<td><label>Materia</label></td>
<td><label>Corso</label></td>
<td><label>Operazioni</label></td>
	<?php 
	
	$result = $conn->query("SELECT * FROM corso");
	while($corso = $result->fetch_assoc()){
	    $id_materia = trovaMateriaCorso($corso['id'], $conn);
	    $id_area_tematica = trovaAreaTematicaMateria($id_materia, $conn);
	    $result2 = $conn->query("SELECT * FROM materia WHERE id = '$id_materia'");
	    $materia = $result2->fetch_assoc();
	    $result3 = $conn->query("SELECT * FROM area_tematica WHERE id = '$id_area_tematica'");
	    $area_tematica = $result3->fetch_assoc();
	    ?>
	    <tr>
	    <td><?php echo $area_tematica['nome'];?></td>
	    <td><?php echo  $materia['nome'];?></td>
	    <td><?php echo $corso['nome'];?></td>
	    <td><button onclick=location.href="corso-ins-<?php echo $corso['id']?>.html">Modifica</button></td>
	    </tr>
	    <?php 
	}
	?>
	<tr>
	<td id="indietro" colspan="4"><strong><a href="corsi.html">
				Indietro</a></strong></td>
</tr>
</table>