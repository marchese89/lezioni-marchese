<?php
session_start();
include 'config/mysql-config.php';

?>
<tr style="height: 60px">
	<td>
	<label style="font-size: 18px">Inserisci nuovo Argomento</label>
	</td>
</tr>
<form action="insegnanti/inserisci_argomento.php" method="post" >
<tr style="height: 60px; " >

	<td><label>Area Tematica - Materia - Corso</label> <select name="corso"  >
	
	<?php
$email = $_SESSION['user'];

$result = $conn->query("SELECT * FROM corso");

while ($argomento = $result->fetch_assoc()) {
    $id_mat = $argomento['materia'];
    $result2 = $conn->query("SELECT * FROM materia WHERE id='$id_mat'");
    $row2 = $result2->fetch_assoc();
    $id_a_t = $row2['area_tematica'];
    $result3 = $conn->query("SELECT * FROM area_tematica WHERE id='$id_a_t'");
    $row3 = $result3->fetch_assoc();
    ?>
	    <option value="<?php echo $argomento['id'];?>"><?php echo $row3['nome']. " - " .$row2['nome'] . " - ". $argomento['nome'];?></option>
	    <?php
}
?>
				
		</select></td>
		
</tr>

<tr style="height: 60px">
	<td><label>Nome Argomento</label><input type="text" name="nome_argomento"
		id="nome_argomento" maxlength="45" size="24" autofocus="true"> <script
			type="text/javascript">
                                    var nome_argomento = new LiveValidation('nome_argomento', {onlyOnSubmit: true});
                                    nome_argomento.add(Validate.Presence);
                                    nome_argomento.add(Validate.TestoEnumeri);
                                </script>
		<input type="submit" value="Inserisci Argomento">
	</td>
</tr>
</form>

<tr style="height: 60px">
	<td><label style="font-size: 18px">Argomenti Inseriti</label></td>
</tr>

	<?php
	$result = $conn->query("SELECT * FROM argomento ORDER BY corso_arg ASC");
	while($argomento = $result->fetch_assoc()){
	    echo '<tr style="height: 60px"><td>';
	    $id_corso = $argomento['corso_arg'];
	    $result2 = $conn->query("SELECT * FROM corso WHERE id='$id_corso' ");
	    $row2 = $result2->fetch_assoc();
	    $id_mat = $row2['materia'];
	    $result3 = $conn->query("SELECT * FROM materia WHERE id='$id_mat' ");
	    $row3 = $result3->fetch_assoc();
	    $id_a_t = $row3['area_tematica'];
	    $result4 = $conn->query("SELECT * FROM area_tematica WHERE id='$id_a_t'");
	    $row4 = $result4->fetch_assoc();
	    $id_arg = $argomento['id'];
	    $result5 = $conn->query("SELECT * FROM lezione WHERE arg_lez='$id_arg'");
	    
	    $to_delete = FALSE;
	    if($result5->num_rows > 0){
	        $to_delete = FALSE;
	    }else{
	        $to_delete = TRUE;
	    }
	    
	    echo "<label>". $row4['nome']. " - " . $row3['nome']." - " . $row2['nome'] . " - " . $argomento['nome'] . "</label><p>";
	    ?>
	    <p>
	    <form action="insegnanti/modifica_argomento.php" method="post" >
	    	<input type="hidden" name="id" value="<?php echo $id_arg;?>">
			<input type="text" id="nome_argomento" name="nome_argomento"  maxlength="45"
				size="24" autofocus="true" >
			<script type="text/javascript">
                                    var nome_argomento = new LiveValidation('nome_argomento', {onlyOnSubmit: true});
                                    nome_argomento.add(Validate.Presence);
                                    nome_argomento.add(Validate.TestoEnumeri);
                                </script>
			<input type="submit" value="Modifica">
		</form>
		
	    <?php
	    if($to_delete){
	        ?>
	        <button class="button" onclick=location.href="insegnanti/elimina_argomento.php?<?php echo 'id='.$id_arg;?>">Elimina</button>
	        
	        <?php 
	    }
	    echo '<p></td></tr>';
	}
	?>
	    
<tr>
			<td align="center" id="indietro" ><strong><a
					href="elenco-corsi.html">
					Indietro</a></strong></td>
		</tr>
