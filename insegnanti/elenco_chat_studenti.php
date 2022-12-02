<table align="center" width="100%" id="pannello_controllo" cellspacing=0
	cellpadding=0 rules=row border=0>

	<tr id="titolo">
		<th colspan=5>Chat con gli studenti</th>
	</tr>
	<tr style="height: 60px">
	<td><label>Id</label></td>
	<td><label>Tipo Prodotto</label></td>
	<td><label>Titolo</label></td>
	<td><label>Studente</label></td>
	<td><label>Operazioni</label></td>
	</tr>
	<?php 
	$id_ins = trovaIdInsegnante($_SESSION['user'], $conn);
	
	$result = $conn->query("SELECT * FROM chat");
	while($chat = $result->fetch_assoc()){
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
	           $id_insegn = trovaIdInsegnanteDaLezione($id_prodotto,$conn);
	           if($id_ins == $id_insegn){
	               ?>
	               <tr style="height: 60px">
	               <td><?php echo $id_prodotto;?></td>
	               <td>Lezione</td>
	               <td><?php echo $lezione['titolo']?></td>
	               <td><?php echo $studente['nome']. " " . $studente['cognome']; ?></td>
	               <td><button onclick=location.href="">Visualizza Chat</button></td>
	               </tr>
	               <?php
	           }
	           break;
	       case 2://esercizio
	           $result2 = $conn->query("SELECT * FROM esercizio WHERE id = '$id_prodotto'");
	           $esercizio = $result2->fetch_assoc();
	           $id_insegn = trovaIdInsegnanteDaEsercizio($id_prodotto,$conn);
	           if($id_ins == $id_insegn){
	               ?>
	               <tr style="height: 60px">
	               <td><?php echo $id_prodotto;?></td>
	               <td>Esercizio</td>
	               <td><?php echo $esercizio['titolo']?></td>
	               <td><?php echo $studente['nome']. " " . $studente['cognome']; ?></td>
	               <td><button onclick=location.href="">Visualizza Chat</button></td>
	               </tr>
	               <?php
	           }
	           break;
	       case 5://lezione su richiesta
	           $result2 = $conn->query("SELECT * FROM richieste_lezioni WHERE id = '$id_prodotto'");
	           $lezione = $result2->fetch_assoc();
	           $id_insegn = trovaIdInsegnanteDaLezioneSuRichiesta($id_prodotto,$conn);
	           if($id_ins == $id_insegn){
	               ?>
	               <tr style="height: 60px">
	               <td><?php echo $id_prodotto;?></td>
	               <td>Esercizio</td>
	               <td><?php echo $lezione['titolo']?></td>
	               <td><?php echo $studente['nome']. " " . $studente['cognome']; ?></td>
	               <td><button onclick=location.href="" >Visualizza Chat</button></td>
	               </tr>
	               <?php
	           }
	           break;
	       default:
	           ;
	       break;
	   }
	}

	?>
	<tr>
			<td align="center" id="indietro" colspan=5><strong><a
					href="home-insegnante.html">
					Indietro</a></strong></td>
		</tr>
</table>