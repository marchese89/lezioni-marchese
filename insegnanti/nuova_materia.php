<?php
session_start();
include 'config/mysql-config.php';

?>
<table id="pannello_controllo" >
	<tr id="titolo">
		<th colspan="4">Inserisci nuova Materia
		</th>
	</tr>

<form action="insegnanti/inserisci_materia.php" method="post">
	<tr style="height: 60px">
		<td colspan="4"><label>Area Tematica</label> <select name="area_tematica">
				
	<?php
$email = $_SESSION['user'];

$result = $conn->query("SELECT * FROM area_tematica");

while ($area_tematica = $result->fetch_assoc()) {
    ?>
	    <option value="<?php echo $area_tematica['id'];?>"><?php echo $area_tematica['nome'];?></option>
	    <?php
}
?>
				
		</select></td>
	</tr>
<tr><td><label>Nome</label></td><td><label>Input</label></td><td colspan="2"><label>Operazioni</label></td></tr>
	<tr style="height: 60px">
	<td><label>Nuova Materia </label></td>
		<td align="center">
			
			<form action="insegnanti/inserisci_materia.php" method="post">
				<input type="text" name="materia"
					id="materia" maxlength="45" size="24" autofocus="true">
				<script type="text/javascript">
                                    var materia = new LiveValidation('materia', {onlyOnSubmit: true});
                                    materia.add(Validate.Presence);
                                    materia.add(Validate.SoloTesto);
                                </script>
                                <td>
				<input type="submit" value="Inserisci">
				</td>
			</form>
		</td>

	</tr>
<tr style="height: 60px">
	<td colspan="4"><label style="font-size: 18px">Materie Inserite</label></td>
</tr>

	<?php
	$result = $conn->query("SELECT * FROM materia");
	while($materia = $result->fetch_assoc()){
	    ?>
	    <tr>
	    <?php 
	    $id_a_t = $materia['area_tematica'];
	    $result2 = $conn->query("SELECT * FROM area_tematica WHERE id='$id_a_t'");
	    $area_tematica = $result2->fetch_assoc();
	    $id_mat = $materia['id'];
	    $result3 = $conn->query("SELECT * FROM corso WHERE materia='$id_mat'");
	    $to_delete;
	    if($result3->num_rows > 0){
	        $to_delete = FALSE;
	    }else{
	        $to_delete = TRUE;
	    }
	    ?>
	    <td><label><?php echo $area_tematica['nome'] . " - ". $materia['nome'];?></label></td>
	    <td>
	    <form action="insegnanti/modifica_materia.php" method="post" >
	    	<input type="hidden" name="id" value="<?php echo $id_mat;?>">
	    	
			<input type="text" id="materia2" name="materia2"  maxlength="45"
				size="24" autofocus="true" >
			<script type="text/javascript">
                                    var materia2 = new LiveValidation('materia2', {onlyOnSubmit: true});
                                    materia2.add(Validate.Presence);
                                    materia2.add(Validate.SoloTesto);
                                </script>
            </td>
            <td>
			<input type="submit" value="Modifica">
			</td>
		</form>
		
	    <?php
	    if($to_delete){
	        ?>
	        <td>
	        <button class="button" onclick=location.href="insegnanti/elimina-materia.php?<?php echo 'id='.$id_mat;?>">Elimina</button>
	        </td>
	        <?php 
	    }
	    
	}
	?>

	<tr>
		<td align="center" id="indietro" colspan="4"><strong><a href="corsi.html"> Indietro</a></strong></td>
	</tr>
	</table>