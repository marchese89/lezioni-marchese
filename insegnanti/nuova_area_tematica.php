<?php
session_start();
include 'config/mysql-config.php';
include 'script/funzioni-php.php';
?>
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
<tr>
	<td>
	<?php
	$result = $conn->query("SELECT * FROM area_tematica");
	while($row = $result->fetch_assoc()){
	    echo "<label>" . $row['nome'] . "</label><p>";
	}
	?>
	</td>
</tr>
<tr>
	<td align="center"><strong><a href="elenco-corsi.html"> Indietro</a></strong></td>
</tr>