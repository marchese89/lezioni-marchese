<?php
$id_chat = $_GET['id_chat'];

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES lezione READ, esercizio READ, richieste_lezioni READ");
$conn->query("BEGIN");

$result = $conn->query("SELECT * FROM chat WHERE id = '$id_chat'");
$chat = $result->fetch_assoc();
$tipo_prodotto = $chat['tipo_prodotto'];
$id_prodotto = $chat['id_prodotto'];
$id_stud = $chat['id_studente'];

$lez = "";
$ex = "";
$lez_rich = ""; 
if ($tipo_prodotto == 0) {
    $result = $conn->query("SELECT * FROM lezione WHERE id='$id_prodotto'");
    $lez = $result->fetch_assoc();
}
if ($tipo_prodotto == 2) {
    $result = $conn->query("SELECT * FROM esercizio WHERE id='$id_prodotto'");
    $ex = $result->fetch_assoc();
}
if ($tipo_prodotto == 5) {
    $result = $conn->query("SELECT * FROM richieste_lezioni WHERE id='$id_prodotto'");
    $lez_rich = $result->fetch_assoc();
}
$conn->query("COMMIT");
$conn->query("UNLOCK TABLES");
?>
<script type="text/javascript">
setInterval(leggi_messaggi, 1000);

function leggi_messaggi() {
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	      if (this.readyState == 4 && this.status == 200) {
	        document.getElementById("messaggi").innerHTML = this.responseText;
	      }
	    };
	    //aut=1 -> insegnante
	    xmlhttp.open("GET","richieste_ajax/leggi_messaggi_insegnante.php?id_prod=<?php echo $id_prodotto;?>&tipo_prod=<?php echo $tipo_prodotto;?>&id_stud=<?php echo $id_stud;?>",true);
	    xmlhttp.send();
	  
}

function invia_messaggio(testo) {
	
	//document.getElementById("messaggi").innerHTML += testo;
	document.getElementById("messaggio").value = "";
	  if (testo == "") {
	    return;
	  } else {
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	      if (this.readyState == 4 && this.status == 200) {
	      }
	    };
	    //aut=1 -> insegnante
	    xmlhttp.open("GET","richieste_ajax/invia_messaggio.php?id_prod=<?php echo $id_prodotto;?>&tipo_prod=<?php echo $tipo_prodotto;?>&id_stud=<?php echo $id_stud;?>&aut=1&testo="+testo,true);
	    xmlhttp.send();
	  }
	}


</script>
<table align="center" width="100%" id="pannello_controllo" cellspacing=0
	cellpadding=0 rules=all border=1>

	<tr id="titolo">
		<th><?php 
		if($tipo_prodotto == 0){
		    echo 'Lezione n.'. $lez['numero'];
		}
		if($tipo_prodotto == 2){
		    echo 'Esercizio n.'. $ex['id'];
		}
		if($tipo_prodotto == 5){
		    echo 'Lezione su richiesta n.'. $lez_rich['id'];
		}
		?></th>
	</tr>
	<tr style="height: 60px">
		<td><label><?php 
		if($tipo_prodotto == 0){ 
		    echo $lez['titolo'];
		}
		if($tipo_prodotto == 2){
		    echo $ex['titolo'];
		}
		if($tipo_prodotto == 5){
		    echo $lez_rich['titolo'];
		}
		?></label></td>
	</tr>
	<tr style="height: 60px">
		<td><label>Traccia</label></td>
	</tr>
	<tr>
		<td><iframe src="<?php 
		if($tipo_prodotto == 0){
		    echo $lez['presentazione'];
		}
		if($tipo_prodotto == 2){
		    echo $ex['traccia'];
		}
		if($tipo_prodotto == 5){
		    echo $lez_rich['traccia'];
		}
		?>#view=FitH"
				width="90%" height="800px"></iframe></td>
	</tr>
	<tr style="height: 60px">
		<td><label>Svolgimento</label></td>
	</tr>
	<tr>
		<td><iframe src="<?php 
		if($tipo_prodotto == 0){
		    echo $lez['lezione'];
		}
		if($tipo_prodotto == 2){
		    echo $ex['svolgimento'];
		}
		if($tipo_prodotto == 5){
		    echo $lez_rich['svolgimento'];
		}
		?>#view=FitH" width="90%"
				height="800px"></iframe></td>
	</tr>
	<tr style="height: 60px">
		<td><label>Chat Chiarimenti</label></td>
	</tr>
	<?php
// codice messaggi precendenti
?>
	<tr style="width: 100%">
		<td style="width: 100%" align="right">
			<div id="messaggi" style="width: 100%"></div>
		</td>
	</tr>
	<tr style="height: 180px">
		<td><textarea id="messaggio" name="messaggio" rows="5" cols="100"
				style="width: 80%; font-size: 18px; resize: none; border-radius: 5px 5px 5px 5px"></textarea>

			<script type="text/javascript">
 					 var input = document.getElementById("messaggio");

					//Execute a function when the user presses a key on the keyboard
					input.addEventListener("keypress", function(event) {
 					// If the user presses the "Enter" key on the keyboard
					if (event.key === "Enter") {
 					// Cancel the default action, if needed
 					event.preventDefault();
					 // Trigger the button element with a click
					 document.getElementById("invia").click();
					}
					});
  </script> <br>
			<button id="invia" onclick=invia_messaggio(document.getElementById("messaggio").value)>Invia</button>

		</td>
	</tr>
	<tr>
		<td align="center" id="indietro"><strong><a
				href="chat-studenti.html">Indietro</a></strong></td>
	</tr>
</table>