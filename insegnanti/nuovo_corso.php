<?php
session_start();
include 'config/mysql-config.php';

?>
<table id="pannello_controllo" >
	<tr id="titolo">
		<th>Inserisci nuovo corso
		</th>
	</tr>

<form action="insegnanti/inserisci_corso.php" method="post" >
<tr style="height: 60px; " >

	<td><label>Area Tematica - Materia</label> <select name="materia"  >
	
	<?php
$email = $_SESSION['user'];

$result = $conn->query("SELECT * FROM materia");

while ($materia = $result->fetch_assoc()) {
    $id_a_t = $materia['area_tematica'];
    $result2 = $conn->query("SELECT * FROM area_tematica WHERE id='$id_a_t'");
    $row2 = $result2->fetch_assoc();
    ?>
	    <option value="<?php echo $materia['id'];?>"><?php echo $row2['nome'] . " - ". $materia['nome'];?></option>
	    <?php
}
?>
				
		</select></td>
		
</tr>

<tr style="height: 60px">
	<td><label>Nome Corso</label><input type="text" name="nome_corso"
		id="nome_corso" maxlength="45" size="24" autofocus="true"> <script
			type="text/javascript">
                                    var nome_corso = new LiveValidation('nome_corso', {onlyOnSubmit: true});
                                    nome_corso.add(Validate.Presence);
                                    nome_corso.add(Validate.TestoEnumeri);
                                </script>
		<input type="submit" value="Inserisci Corso">
	</td>
</tr>
</form>

<tr style="height: 60px">
	<td><label style="font-size: 18px">Corsi Inseriti</label></td>
</tr>

	<?php
	$ins = trovaIdInsegnante($email,$conn);
	$result = $conn->query("SELECT * FROM corso WHERE insegnante='$ins' ORDER BY materia ASC");
	
	while($corso = $result->fetch_assoc()){
	    echo '<tr style="height: 60px"><td><br>';
	    $id_mat = $corso['materia'];
	    $id_corso = $corso['id'];
	    $result2 = $conn->query("SELECT * FROM materia WHERE id='$id_mat' ");
	    $materia = $result2->fetch_assoc();
	    $id_a_t = $materia['area_tematica'];
	    $result3 = $conn->query("SELECT * FROM area_tematica WHERE id='$id_a_t'");
	    $area_tematica = $result3->fetch_assoc();
	    $result4 = $conn->query("SELECT * FROM lezione WHERE corso_lez = '$id_corso'");
	    $to_delete = FALSE;
	    if($result4->num_rows > 0){
	        $to_delete = FALSE;
	    }else{
	        $to_delete = TRUE;
	    }
	    echo "<label>". $area_tematica['nome']." - " . $materia['nome'] . " - ". $corso['nome'] . "</label><p>";
	    ?>
	    <p>
	    <form action="insegnanti/modifica_corso.php" method="post" >
	    	<input type="hidden" name="id" value="<?php echo $id_corso;?>">
			<input type="text" id="nome_corso2" name="nome_corso2"  maxlength="45"
				size="24" autofocus="true" >
			<script type="text/javascript">
                                    var nome_corso2 = new LiveValidation('nome_corso2', {onlyOnSubmit: true});
                                    nome_corso2.add(Validate.Presence);
                                    nome_corso2.add(Validate.TestoEnumeri);
                                </script>
			<input type="submit" value="Modifica">
		</form>
		
	    <?php
	    if($to_delete){
	        ?>
	        <button class="button" onclick=location.href="insegnanti/elimina-corso.php?<?php echo 'id='.$id_corso;?>">Elimina</button>
	        
	        <?php 
	    }
	    echo '<p></td></tr>';
	}
	?>
	    
<tr>
			<td align="center" id="indietro" ><strong><a
					href="corsi.html">
					Indietro</a></strong></td>
		</tr>
</table>