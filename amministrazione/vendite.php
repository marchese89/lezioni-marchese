<script>
function carica_vendite_insegnante(id_insegnante) {
	
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            document.getElementById("vendite_insegnante").innerHTML = xmlhttp.responseText;
        }
    }

    xmlhttp.open("GET", "richieste_ajax/carica_vendite_insegnante.php?id_ins="+id_insegnante, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();

}
</script>
<table id="pannello_controllo" align="center" cellspacing=0
	cellpadding=0 width="100%">
	<tr id="titolo">
		<th style="height: 60px" align="center" colspan=5><span
			style="color: #0e83cd; font-size: 24px">Vendite</span><br></th>
	</tr>
	<tr>
		<td colspan="5"><label>Insegnante&nbsp;</label><select name="insegnante" id="insegnante"
			onchange="carica_vendite_insegnante(this.value)">
				<option value="0"></option>
				<option value="-1">Tutti gli Insegnanti</option>
				<?php 
				$r = $conn->query("SELECT * FROM insegnante");
				while($ins = $r->fetch_assoc()){
				    $id_ut = $ins['utente_i'];
				    $r2 = $conn->query("SELECT * FROM utente WHERE id = '$id_ut'");
				    $utente = $r2->fetch_assoc();
				    ?>
				    <option value="<?php echo $ins['id']?>"><?php echo $utente['nome']. " " . $utente['cognome']; ?></option>
				    <?php 
				}
				?>
		</select></td>
	</tr>
	
	<tr>
	<td colspan="5">
	<div id="vendite_insegnante"></div>
	</td>
	</tr>
	<tr>
		<td align="center" id="indietro" colspan=5><strong><a
				href="home-admin.html"> Indietro</a></strong></td>
	</tr>
</table>