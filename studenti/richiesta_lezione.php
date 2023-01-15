<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login2.html");
}

if(studente($_SESSION['user'],$conn)){
?>

<table align="center" id="pannello_controllo" >
	
		<tr id="titolo">
			<th>Richiesta Svolgimento lezione su Commissione</th>
		</tr>
		<tr>
		<td>
		<label>Inserisci un file "traccia" per richiedere lo svolgimento di una lezione su commissione,</label>
		</td>
		</tr>
		<tr>
		<td>
		<label>lo svolgimento o la correzione di un esercizio</label>
		</td>
		</tr>
		<tr>
		<td>
		<label>Verrà prodotta una risposta che sar&agrave; visibile sul tuo profilo studente</label>
		</td>
		</tr>
		<tr>
		<td>
		<label>A quel punto potrai vedere il prezzo e decidere se acquistarla</label>
		</td>
		</tr>
		<tr>
		<td>
		<label>Sono inclusi nel prezzo eventuali chiarimenti via chat (disponibili dopo l'acquisto)</label>
		</td>
		</tr>
		<tr>
		<td><input type="button" value="Avanti" onclick=location.href="richiesta_lezione2.html"></td>
		</tr>

</table>

<?php 
}else{
    ?>
    <table align="center" id="pannello_controllo" >
    
    <tr id="titolo">
    <th>Richiesta Svolgimento lezione su Commissione</th>
    </tr>
    <tr style="height: 60px">
    <td><font color="red" style="font-size: 18px">Devi fare il login come studente per accedere a questa funzionalità</font></td>
    </tr>
    </table>
    <?php 
}
?>