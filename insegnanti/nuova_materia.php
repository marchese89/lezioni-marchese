<?php
session_start();
include 'config/mysql-config.php';

?>
<tr style="height: 60px">
	<td><label style="font-size: 18px">Inserisci nuova Materia</label>
	</td>
</tr>

<form action="insegnanti/inserisci_materia.php" method="post">
	<tr style="height: 60px">
		<td><label>Area Tematica</label> <select name="area_tematica">
				
	<?php
$email = $_SESSION['user'];

$result = $conn->query("SELECT * FROM area_tematica");

while ($argomento = $result->fetch_assoc()) {
    ?>
	    <option value="<?php echo $argomento['id'];?>"><?php echo $argomento['nome'];?></option>
	    <?php
    $i ++;
}
?>
				
		</select></td>
	</tr>

	<tr style="height: 60px">
		<td align="center">

			<form action="insegnanti/inserisci_materia.php" method="post">
				<label>Nuova Materia </label><input type="text" name="materia"
					id="materia" maxlength="45" size="24" autofocus="true">
				<script type="text/javascript">
                                    var materia = new LiveValidation('materia', {onlyOnSubmit: true});
                                    materia.add(Validate.Presence);
                                    materia.add(Validate.SoloTesto);
                                </script>
				<input type="submit" value="Inserisci">
			</form>
		</td>

	</tr>
<tr style="height: 60px">
	<td><label style="font-size: 18px">Materie Inserite</label></td>
</tr>

	<?php
	$result = $conn->query("SELECT * FROM materia");
	while($argomento = $result->fetch_assoc()){
	    echo '<tr style="height: 60px"><td>';
	    $id_a_t = $argomento['area_tematica'];
	    $result2 = $conn->query("SELECT * FROM area_tematica WHERE id='$id_a_t'");
	    $row2 = $result2->fetch_assoc();
	    $id_mat = $argomento['id'];
	    $result3 = $conn->query("SELECT * FROM corso WHERE materia='$id_mat'");
	    $to_delete;
	    if($result3->num_rows > 0){
	        $to_delete = FALSE;
	    }else{
	        $to_delete = TRUE;
	    }
	    echo "<p><label> " . $row2['nome']. " - ". $argomento['nome'] . "</label>";
	    ?>
	    <p>
	    <form action="insegnanti/modifica_materia.php" method="post" >
	    	<input type="hidden" name="id" value="<?php echo $id_mat;?>">
			<input type="text" id="materia2" name="materia2"  maxlength="45"
				size="24" autofocus="true" >
			<script type="text/javascript">
                                    var materia2 = new LiveValidation('materia2', {onlyOnSubmit: true});
                                    materia2.add(Validate.Presence);
                                    materia2.add(Validate.SoloTesto);
                                </script>
			<input type="submit" value="Modifica">
		</form>
		
	    <?php
	    if($to_delete){
	        ?>
	        <button class="button" onclick=location.href="insegnanti/elimina-materia.php?<?php echo 'id='.$id_mat;?>">Elimina</button>
	        
	        <?php 
	    }
	    echo '<p></td></tr>';
	}
	?>

	<tr>
		<td align="center" id="indietro"><strong><a href="elenco-corsi.html"> Indietro</a></strong></td>
	</tr>