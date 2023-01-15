<table id="pannello_controllo">
	<tr id="titolo">
		<th colspan=5>Richieste degli Studenti</th>
	</tr>
	<tr style="height: 60px">
		<td style="width: 40%"><label>Id</label></td>
		<td><label>Nome</label></td>
		<td><label>Data</label></td>
		<td><label>Evasa</label></td>
		<td><label>Operazioni</label></td>
	</tr>
	<?php

$result = $conn->query("SELECT * FROM richieste_lezioni  ORDER BY data DESC");
while ($richiesta = $result->fetch_assoc()) {
        ?>
	    <tr style="height: 60px">
		<td><?php echo $richiesta['id'];?></td>
		<td><?php echo $richiesta['titolo'];?></td>
		<td>
	    <?php
        $d = stampa_data($richiesta['data']);
        echo $d['giorno'] . '-' . $d['mese'] . '-' . $d['anno'] . '-' . $d['ora'];
        ?>
	    </td>
		<td><img
			src="<?php
        if ($richiesta['evasa'] == 1) {
            echo 'images/green_spot.png';
        } else {
            echo 'images/red_spot.png';
        }
        ?>"
			style="width: 50px; height: 50px"></td>
		<td>
			<button onclick=location.href="visualizza-richiesta-lezione-i-<?php echo $richiesta['id'];?>.html">Visualizza</button>
		</td>
	</tr> 
	    <?php
    
}
?>
		<tr>
		<td align="center" id="indietro" colspan=6><strong><a
				href="home-insegnante.html"> Indietro</a></strong></td>
	</tr>
</table>