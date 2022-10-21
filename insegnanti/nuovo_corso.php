<?php
session_start();
include 'config/mysql-config.php';
include 'script/funzioni-php.php';
?>
<tr style="height: 60px">
	<td>
	<label style="font-size: 18px">Inserisci nuovo corso</label>
	</td>
</tr>
<form action="insegnanti/inserisci_corso.php" method="post" >
<tr style="height: 60px; " >

	<td><label>Area Tematica - Materia</label> <select name="materia"  >
	<option value=0></option>
	<?php
$email = $_SESSION['user'];
$id_insegnante = trova_id_insegnante($email);
$result = $conn->query("SELECT * FROM materia");
$i = 1;
while ($row = $result->fetch_assoc()) {
    $id_a_t = $row['area_tematica'];
    $result2 = $conn->query("SELECT * FROM area_tematica WHERE id='$id_a_t'");
    $row2 = $result2->fetch_assoc();
    ?>
	    <option value="<?php echo $row['id'];?>"><?php echo $row2['nome'] . " - ". $row['nome'];?></option>
	    <?php
    $i ++;
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
<tr>
	<td>
	<?php
	$result = $conn->query("SELECT * FROM corso");
	while($row = $result->fetch_assoc()){
	    echo "<label>" . $row['nome'] . "</label><p>";
	}
	?>
	</td>
</tr>
<tr>
			<td align="center"><strong><a
					href="elenco-corsi.html">
					Indietro</a></strong></td>
		</tr>
