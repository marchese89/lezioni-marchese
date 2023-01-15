<table align="center" width="100%" id="pannello_controllo" cellspacing=0
	cellpadding=0 rules=row border=0>

	<tr id="titolo">
		<th colspan=6>Chat con gli studenti</th>
	</tr>
	<tr style="height: 60px">
	<td colspan=6><label>Legenda:  <font style="color:green;">verde</font>:ok, <font style="color: red;">rosso</font>: richiede risposta, <font style="color: blue;">blu</font>: chat non avviata</label></td>
	</tr>
	<tr style="height: 60px">
	<td><label>Id</label></td>
	<td><label>Tipo Prodotto</label></td>
	<td><label>Titolo</label></td>
	<td><label>Studente</label></td>
	<td><label>Stato</label></td>
	<td><label>Operazioni</label></td>
	</tr>
	<?php 
	
	$result = $conn->query("SELECT * FROM chat ORDER BY id DESC");
	while($chat = $result->fetch_assoc()){
	   //vediamo di chi è l'ultimo messaggio
	   $id_chat  =  $chat['id'];
	   $rr1  = $conn->query("SELECT * FROM messaggi_chat WHERE id_chat = '$id_chat' ORDER BY data DESC");
	   $ultimo_messaggio =  $rr1->fetch_assoc();
	   $id_prodotto = $chat['id_prodotto'];
	   $tipo_prodotto = $chat['tipo_prodotto'];
	   $id_stud = $chat['id_studente'];
	   $result3 = $conn->query("SELECT * FROM studente WHERE id = '$id_stud'");
	   $stud = $result3->fetch_assoc();
	   $ut = $stud['utente_s'];
	   $result4 = $conn->query("SELECT * FROM utente WHERE id = '$ut'");
	   $studente = $result4->fetch_assoc();
	   switch ($tipo_prodotto) {
	       case 0://lezione
	           $result2 = $conn->query("SELECT * FROM lezione WHERE id = '$id_prodotto'");
	           $lezione = $result2->fetch_assoc();
	               ?>
	               <tr style="height: 60px">
	               <td><?php echo $id_prodotto;?></td>
	               <td>Lezione</td>
	               <td><?php echo $lezione['titolo']?></td>
	               <td><?php echo $studente['nome']. " " . $studente['cognome']; ?></td>
	               <td><img src="<?php 
	               if($rr1->num_rows == 0){
	                   echo 'images/blue_spot.png';
	               }else if($ultimo_messaggio['autore'] == 0){
	                   echo 'images/red_spot.png';}
	               else if($ultimo_messaggio['autore'] == 1){
	                   echo 'images/green_spot.png';
	               }
	                   ?>" style="width: 50px;height:50px" ></td>
	               <td><button onclick=location.href="chat-con-studenti-<?php echo $id_chat;?>.html">Visualizza Chat</button></td>
	               </tr>
	               <?php
	           
	           break;
	       case 2://esercizio
	           $result2 = $conn->query("SELECT * FROM esercizio WHERE id = '$id_prodotto'");
	           $esercizio = $result2->fetch_assoc();
	               ?>
	               <tr style="height: 60px">
	               <td><?php echo $id_prodotto;?></td>
	               <td>Esercizio</td>
	               <td><?php echo $esercizio['titolo']?></td>
	               <td><?php echo $studente['nome']. " " . $studente['cognome']; ?></td>
	               <td><img src="<?php 
	               if($rr1->num_rows == 0){
	                   echo 'images/blue_spot.png';
	               }else if($ultimo_messaggio['autore'] == 0){
	                   echo 'images/red_spot.png';}
	                   else if($ultimo_messaggio['autore'] == 1){
	                       echo 'images/green_spot.png';
	                   }
	               ?>" style="width: 50px;height:50px" ></td>
	               <td><button onclick=location.href="chat-con-studenti-<?php echo $id_chat;?>.html">Visualizza Chat</button></td>
	               </tr>
	               <?php
	           break;
	       case 5://lezione su richiesta
	           $result2 = $conn->query("SELECT * FROM richieste_lezioni WHERE id = '$id_prodotto'");
	           $lezione = $result2->fetch_assoc();
	               ?>
	               <tr style="height: 60px">
	               <td><?php echo $id_prodotto;?></td>
	               <td>Lezione su Richiesta</td>
	               <td><?php echo $lezione['titolo']?></td>
	               <td><?php echo $studente['nome']. " " . $studente['cognome']; ?></td>
	               <td><img src="<?php 
	               if($rr1->num_rows == 0){
	                   echo 'images/blue_spot.png';
	               }else if($ultimo_messaggio['autore'] == 0){
	                   echo 'images/red_spot.png';}
	                   else if($ultimo_messaggio['autore'] == 1){
	                       echo 'images/green_spot.png';
	                   }
	               ?>" style="width: 50px;height:50px" ></td>
	               <td><button onclick=location.href="chat-con-studenti-<?php echo $id_chat;?>.html" >Visualizza Chat</button></td>
	               </tr>
	               <?php
	           break;
	       default:
	           ;
	       break;
	   }
	}

	?>
	<tr>
			<td align="center" id="indietro" colspan=6><strong><a
					href="home-insegnante.html">
					Indietro</a></strong></td>
		</tr>
</table>