<?php
$id_lezione = $_GET['id'];
$result = $conn->query("SELECT * FROM richieste_lezioni WHERE id = '$id_lezione'");
$richiesta = $result->fetch_assoc();

$id_stud = trovaIdStudente($_SESSION['user'], $conn);
$result = $conn->query("SELECT * FROM richieste_lezioni WHERE id = '$id_lezione'");
$richiesta = $result->fetch_assoc();
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
	    xmlhttp.open("GET","richieste_ajax/leggi_messaggi.php?id_prod=<?php echo $id_lezione;?>&tipo_prod=5&id_stud=<?php echo $id_stud;?>",true);
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
	    xmlhttp.open("GET","richieste_ajax/invia_messaggio.php?id_prod=<?php echo $id_lezione;?>&tipo_prod=5&id_stud=<?php echo $id_stud;?>&aut=0&testo="+testo,true);
	    xmlhttp.send();
	  }
	}
function invia_feefback(studente,prodotto,tipo_prodotto,punteggio) {
	
	   var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	      if (this.readyState == 4 && this.status == 200) {
	        document.getElementById("stars").innerHTML = this.responseText;
	      }
	    };
	    //aut=0 -> studente
	    xmlhttp.open("GET","richieste_ajax/invia_feedback.php?stud="+studente+"&prod="+prodotto+"&tipo_prod="+tipo_prodotto+"&punt="+punteggio,true);
	    xmlhttp.send();
	  
}

</script>

<table align="center" width="100%" id="pannello_controllo" cellspacing=0
	cellpadding=0>

	<tr id="titolo">
		<th colspan=4>Lezione su Richiesta: <?php echo  $richiesta['titolo'];?></th>
	</tr>
	<tr style="height: 60px">
		<td><label>Traccia</label></td>

	</tr>
	<tr style="height: 60px">
		<td><iframe src="<?php echo $richiesta['traccia'];?>#view=FitH"
				width="90%" height="800px"></iframe></td>
	</tr>
	<tr style="height: 60px">
		<td><label>Svolgimento</label></td>

	</tr>


	<tr style="height: 60px">
		<td><iframe src="<?php echo $richiesta['svolgimento'];?>#view=FitH"
				width="90%" height="800px"></iframe></td>
	</tr>

	<tr>
	
	
	<tr style="height: 60px">
		<td><label>Valutazione </label>
		<?php
$rr1 = $conn->query("SELECT * FROM feedback WHERE studente = '$id_stud' AND prodotto = '$id_lezione' AND tipo_prodotto = '5'");
$f = 0;
if ($rr1->num_rows > 0) {
    $feed = $rr1->fetch_assoc();
    $f = $feed['punteggio'];
}
?>
		<div class="stars" id="stars">
				<a <?php if($f > 0){?> style="opacity: 100%;" <?php }?>
					onclick="invia_feefback(<?php echo $id_stud?>,<?php echo $id_lezione?>,5,1)"
				>⭐</a>
				<a <?php if($f > 1){?> style="opacity: 100%;" <?php }?>
					onclick="invia_feefback(<?php echo $id_stud?>,<?php echo $id_lezione?>,5,2)"
					>⭐</a>
				<a <?php if($f > 2){?> style="opacity: 100%;" <?php }?>
					onclick="invia_feefback(<?php echo $id_stud?>,<?php echo $id_lezione?>,5,3)"
					>⭐</a>
				<a <?php if($f > 3){?> style="opacity: 100%;" <?php }?>
					onclick="invia_feefback(<?php echo $id_stud?>,<?php echo $id_lezione?>,5,4)"
					>⭐</a>
				<a <?php if($f > 4){?> style="opacity: 100%;" <?php }?>
					onclick="invia_feefback(<?php echo $id_stud?>,<?php echo $id_lezione?>,5,5)"
					>⭐</a>
			</div>
	
	</tr>
	<tr style="height: 60px">
		<td><label>Chat Chiarimenti sulla lezione</label></td>
	</tr>
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
	<td align="center" id="indietro" colspan=4><strong><a
			href="lezioni-su-richiesta-acquistate.html"> Indietro</a></strong></td>
	</tr>
</table>