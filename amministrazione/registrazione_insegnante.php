<?php
session_start();

?>

<table style="width: 100%; font-size: 28pt; font-family: cursive;"id="pannello_controllo">
	<tr style="height: 100px; align-content: center">
		<td><b>Sei un <font color="green">insegnante</font>?
		</b></td>
	</tr>
	<tr style="height: 100px">
		<td><b>Vuoi utilizzare questa <font
				color="green">piattaforma</font>?
		</b>
		
		<td></td>
	</tr>
	<tr style="height: 100px">
		<td><b>Invia la tua <font color="green">candidatura</font>! 
	<tr>
	<td colspan="2"><input type="button" value="Avanti" onclick=location.href="registrazione-insegnante-1.html"></td>
	</tr>
</table>
<table style="width: 100%; font-size: 18pt">
	<tr style="height: 40px; align-content: center">
		<td style="color: red;"><b>
		<?php 
		if(isset($_SESSION['file_non_caricati'])){
		    echo 'Alcuni file non sono stati caricati!';
		}
		?>
		</b>
		</td>
	</tr>
	

</table>




