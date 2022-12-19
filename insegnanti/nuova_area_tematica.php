<table id="pannello_controllo" >
	<tr id="titolo">
		<th>Nuova Area Tematica
		</th>
	</tr>
<tr style="height: 60px">
	<td><label style="font-size: 18px">Inserisci nuova Area Tematica</label>
	</td>
</tr>

<tr style="height: 60px">
	<td align="center">

		<form action="insegnanti/inserisci_area_tematica.php" method="post">
			<label>Nuova Area Tematica </label><input type="text"
				name="area_tematica" id="area_tematica" maxlength="45" size="24"
				autofocus="true">
			<script type="text/javascript">
                                    var area_tematica = new LiveValidation('area_tematica', {onlyOnSubmit: true});
                                    area_tematica.add(Validate.Presence);
                                    area_tematica.add(Validate.SoloTesto);
                                </script>
			<input type="submit" value="Inserisci">
		</form>
	</td>

</tr>
<tr style="height: 60px">
	<td><label style="font-size: 18px">Aree Tematiche Inserite</label></td>
</tr>

	<?php
$result = $conn->query("SELECT * FROM area_tematica");
while ($argomento = $result->fetch_assoc()) {
    echo '<tr style="height: 60px" align="center"><td><span>';
    $id_a_t = $argomento['id'];
    $result2 = $conn->query("SELECT * FROM materia WHERE area_tematica='$id_a_t'");
    $to_delete;
    if ($result2->num_rows > 0) {
        $to_delete = FALSE;
    } else {
        $to_delete = TRUE;
    }
    echo "<label>" . $argomento['nome'] . "</label>";
    ?>
	    <form action="insegnanti/modifica_area_tematica.php" method="post" >
	    	<input type="hidden" name="id" value="<?php echo $id_a_t;?>">
			<input type="text" id="area_tem" name="area_tem"  maxlength="45"
				size="24" autofocus="true" >
			<script type="text/javascript">
                                    var area_tem = new LiveValidation('area_tem', {onlyOnSubmit: true});
                                    area_tem.add(Validate.Presence);
                                    area_tem.add(Validate.SoloTesto);
                                </script>
			<input type="submit" value="Modifica">
		</form>
		
	    <?php
    if ($to_delete) {
        ?>
	        <button class="button" onclick=location.href="insegnanti/elimina-area-tematica.php?<?php echo 'id='.$id_a_t;?>">Elimina</button>
		<p>
	        <?php
    } 
    echo "</span></td></tr>";
}
?>
		

<tr>
	<td align="center" id="indietro"><strong><a href="corsi.html">
				Indietro</a></strong></td>
</tr>
</table>