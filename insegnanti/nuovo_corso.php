<?php
session_start();
include 'config/mysql-config.php';

?>
<table id="pannello_controllo" >
	<tr id="titolo" >
		<th colspan="6">Inserisci nuovo corso
		</th>
	</tr>

<form action="insegnanti/inserisci_corso.php" method="post" >
<tr>

	<td colspan="6"><label>Area Tematica - Materia</label> <select name="materia"  >
	
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
<tr><td colspan="2"><label>Nome</label></td><td colspan="2"><label>Input</label></td><td colspan="2"><label>Operazioni</label></td></tr>
<tr>
	<td colspan="2" >Nuovo Corso</td><td colspan="2"><input type="text" name="nome_corso"
		id="nome_corso" maxlength="45" size="24" autofocus="true"> <script
			type="text/javascript">
                                    var nome_corso = new LiveValidation('nome_corso', {onlyOnSubmit: true});
                                    nome_corso.add(Validate.Presence);
                                    nome_corso.add(Validate.TestoEnumeri);
                                </script>
                                </td>
                                <td>
		<input type="submit" value="Inserisci Corso">
		</td>
	</td>

</form>
</tr>
<tr>
	<td colspan="6"><label style="font-size: 18px">Corsi Inseriti</label></td>
</tr>
<tr>
<td><label>Area Tematica</label></td>
<td><label>Materia</label></td>
<td><label>Corso</label></td>
<td><label>Input</label></td>
<td colspan="2"><label>Operazioni</label></td></tr>
	<?php
	$result = $conn->query("SELECT * FROM corso ORDER BY materia ASC");
	
	while($corso = $result->fetch_assoc()){
	    ?>
	    <tr>
	    <?php 
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
	    ?>
	    <td>
	    <?php echo $area_tematica['nome']; ?>
	    </td>
	    <td>
	    <?php echo $materia['nome']; ?>
	    </td>
	    <td>
	    <?php echo $corso['nome']; ?>
	    </td>
	    
	    <form action="insegnanti/modifica_corso.php" method="post" >
	    	<input type="hidden" name="id" value="<?php echo $id_corso;?>">
	    	<td>
			<input type="text" id="nome_corso2" name="nome_corso2"  maxlength="45"
				size="24" autofocus="true" >
			<script type="text/javascript">
                                    var nome_corso2 = new LiveValidation('nome_corso2', {onlyOnSubmit: true});
                                    nome_corso2.add(Validate.Presence);
                                    nome_corso2.add(Validate.TestoEnumeri);
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
	        <button class="button" onclick=location.href="insegnanti/elimina-corso.php?<?php echo 'id='.$id_corso;?>">Elimina</button>
	        </td>
	        <?php 
	    }else{
	        ?>
	        <td></td>
	        <?php 
	    }
	    ?>
	    </tr>
	<?php 
	}
	?>
	    
<tr>
			<td align="center" id="indietro" colspan="6"><strong><a
					href="corsi.html">
					Indietro</a></strong></td>
		</tr>
</table>