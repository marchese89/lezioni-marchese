<?php
session_start();
include 'config/mysql-config.php';
include 'script/funzioni-php.php';
?>
<form action="insegnanti/inserisci_materia.php" method="post">
	<tr style="height: 60px">
		<td><label>Area Tematica</label> <select name="area_tematica"
			onclick="caricaMateria()">
				<option value=0></option>
	<?php
$email = $_SESSION['user'];
$id_insegnante = trova_id_insegnante($email);
$result = $conn->query("SELECT * FROM area_tematica");

while ($row = $result->fetch_assoc()) {
    ?>
	    <option value="<?php echo $row['id'];?>"><?php echo $row['nome'];?></option>
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
<tr>
	<td>
	<?php
	$result = $conn->query("SELECT * FROM materia");
	while($row = $result->fetch_assoc()){
	    $id_a_t = $row['area_tematica'];
	    $result2 = $conn->query("SELECT * FROM area_tematica WHERE id='$id_a_t'");
	    $row2 = $result2->fetch_assoc();
	    echo "<label> " . $row2['nome']. " - ". $row['nome'] . "</label> <p>" ;
	}
	?>
	</td>
</tr>
	<tr>
		<td align="center"><strong><a href="elenco-corsi.html"> Indietro</a></strong></td>
	</tr>