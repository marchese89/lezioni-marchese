<?php
$id_lez = $_GET['id'];
$id_corso = $_GET['corso'];
$id_stud = trovaIdStudente($_SESSION['user'], $conn);
$result = $conn->query("SELECT * FROM lezione WHERE id='$id_lez'");
$lez = $result->fetch_assoc();
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
	    //aut=0 -> studente
	    xmlhttp.open("GET","richieste_ajax/leggi_messaggi.php?id_prod=<?php echo $id_lez;?>&tipo_prod=0&id_stud=<?php echo $id_stud;?>",true);
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
	        //document.getElementById("messaggi").innerHTML = this.responseText;
	      }
	    };
	    //aut=0 -> studente
	    xmlhttp.open("GET","richieste_ajax/invia_messaggio.php?id_prod=<?php echo $id_lez;?>&tipo_prod=0&id_stud=<?php echo $id_stud;?>&aut=0&testo="+testo,true);
	    xmlhttp.send();
	  }
	}


function aggiungi_corso(){
	var form = document.getElementById('form_ex');
    var input = document.createElement('input');
    input.setAttribute('name', 'corso');
    input.setAttribute('value', document.getElementById('select_corso').value);
    input.setAttribute('type', 'hidden');
    form.appendChild(input);
}

</script>
<table align="center" width="100%" id="pannello_controllo" cellspacing=0
	cellpadding=0 rules=all border=1>

	<tr id="titolo">
		<th>Lezione n. <?php echo $lez['numero']?></th>
	</tr>
	<tr style="height: 60px">
		<td><label><?php echo $lez['titolo']?></label></td>
	</tr>
	<tr style="height: 60px">
		<td><label>Presentazione</label></td>
	</tr>
	<tr>
		<td><iframe src="<?php echo $lez['presentazione'];?>#view=FitH"
				width="90%" height="800px"></iframe></td>
	</tr>
	<tr style="height: 60px">
		<td><label>Lezione</label></td>
	</tr>
	<tr>
		<td><iframe src="<?php echo $lez['lezione'];?>#view=FitH" width="90%"
				height="800px"></iframe></td>
	</tr>
	<tr style="height: 60px">
		<td><label>Chat Chiarimenti sulla lezione</label></td>
	</tr>
	<?php
// codice messaggi precendenti
?>
	<tr style="width: 100%">
		<td style="width: 100%" align="right">
			<div id="messaggi"  style="width: 100%"></div>
		</td>
	</tr>
	<tr style="height: 180px">
		<td><textarea id="messaggio" name="messaggio" rows="5" cols="100"
				style="width: 80%; font-size: 18px; resize: none;border-radius: 5px 5px 5px 5px"></textarea> 
				
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
  </script> 


  <br>
			<button id="invia" onclick=invia_messaggio(document.getElementById("messaggio").value)>Invia</button>

		</td>
	</tr>
	<tr>
		<td align="center" id="indietro"><strong><a
				href="corso-studente-<?php echo $id_corso;?>.html">Indietro</a></strong></td>
	</tr>
</table>