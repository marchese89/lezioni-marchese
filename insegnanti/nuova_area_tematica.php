<table id="pannello_controllo" >
	<tr id="titolo">
		<th colspan="4">Nuova Area Tematica
		</th>
	</tr>
<tr>
	<td colspan="4"><label style="font-size: 18px">Inserisci nuova Area Tematica</label>
	</td>
</tr>
<tr><td><label>Nome</label></td><td><label>Input</label></td><td colspan="2"><label>Operazioni</label></td></tr>
<tr style="height: 60px">
<td><label>Nuova Area Tematica</label></td>
	<td align="center">

		<form action="insegnanti/inserisci_area_tematica.php" method="post">
			<input type="text"
				name="area_tematica" id="area_tematica" maxlength="45" size="24"
				autofocus="true">
			<script type="text/javascript">
                                    var area_tematica = new LiveValidation('area_tematica', {onlyOnSubmit: true});
                                    area_tematica.add(Validate.Presence);
                                    area_tematica.add(Validate.SoloTesto);
                                </script>
                                </td>
                                <td>
			<input type="submit" value="Inserisci">
			</td>
		</form>
	</td>

</tr>
<tr>
	<td colspan="4"><label style="font-size: 18px">Aree Tematiche Inserite</label></td>
</tr>

	<?php
$result = $conn->query("SELECT * FROM area_tematica");
while ($area_tematica = $result->fetch_assoc()) {
    ?>
    <tr>
    <?php 
    $id_a_t = $area_tematica['id'];
    $result2 = $conn->query("SELECT * FROM materia WHERE area_tematica='$id_a_t'");
    $to_delete;
    if ($result2->num_rows > 0) {
        $to_delete = FALSE;
    } else {
        $to_delete = TRUE;
    }
    ?>
    <tr>
    <td>
    <label>  <?php  echo  $area_tematica['nome']; ?> </label>
    </td>
    <td>
	    <form action="insegnanti/modifica_area_tematica.php" method="post" >
	    	<input type="hidden" name="id" value="<?php echo $id_a_t;?>">
			<input type="text" id="area_tem" name="area_tem"  maxlength="45"
				size="24" autofocus="true" >
			<script type="text/javascript">
                                    var area_tem = new LiveValidation('area_tem', {onlyOnSubmit: true});
                                    area_tem.add(Validate.Presence);
                                    area_tem.add(Validate.SoloTesto);
                                </script>
                                </td>
                                <td>
			<input type="submit" value="Modifica">
			</td>
		</form>
		
	    <?php
    if ($to_delete) {
        ?>
	        <td>
	        <button class="button" onclick=location.href="insegnanti/elimina-area-tematica.php?<?php echo 'id='.$id_a_t;?>">Elimina</button>
			</td>
	        <?php
    }else{
        ?>
        <td></td>
        <?php 
    }
    ?>
    </td></tr>
<?php 
}
?>
	</tr>	

<tr>
	<td align="center" id="indietro" colspan="4"><strong><a href="corsi.html">
				Indietro</a></strong></td>
</tr>
</table>