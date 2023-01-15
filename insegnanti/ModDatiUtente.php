<?php

if(!$conn){
    header("Location: ../index.html");
}
session_start();
$email_utente = $_SESSION['user'];

$result =  $conn->query("SELECT * FROM amministratore");
$insegnante = $result->fetch_assoc();

?>


<table id="pannello_controllo" cellspacing="0" cellspadding="0" width="100%" align="center" >
    <tr style="height: 70px" id="titolo">
        <th align="center" colspan="2" style="color: #0e83cd;font-size: 26px">
            Modifica Dati Profilo
        </th>
    </tr>
    <tr>
		<td><label>Foto</label></td>
	</tr>
	<tr>
		<td><p><img src="<?php echo $insegnante['foto'];?>" height="250"
			width="250"></td>
	</tr>
	<tr>
		<td><button class="button" onclick=location.href="modifica_foto_ins.html">Modifica Foto</button></td>
	</tr>

	<td align="center" id="indietro" style="height: 60px"><strong><a
					href="home-insegnante.html">
					Indietro</a></strong></td>
		</tr>



</table>

