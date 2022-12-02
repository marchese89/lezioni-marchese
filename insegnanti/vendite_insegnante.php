<table id="pannello_controllo" align="center" cellspacing=0 cellpadding=0 width="100%"> 
	<tr id="titolo">
		<th style="height: 60px" align="center" colspan=5><span
			style="color: #0e83cd; font-size: 24px">Vendite</span><br></th>
	</tr>

	<tr style="height: 60px">
	<td><label>Id</label></td>
	<td><label>Data Ordine</label></td>
	<td><label>Tipo</label></td>
	<td><label>Titolo</label></td>
	<td><label>Prezzo</label></td>
	</tr>
	<?php 
	$id_insegnante = trovaIdInsegnante($_SESSION['user'], $conn);
	$result = $conn->query("SELECT * FROM prodotti_ordine PO,ordine O WHERE PO.id_ordine = O.id ORDER BY O.data DESC");
	$mese_in_stampa = "";
	$totale_mensile = 0;
	$numero_righe = $result->num_rows;
	$riga_corrente = 0;
	while($prodotto = $result->fetch_assoc()){
	    $tipo = $prodotto['tipo'];
	    $id  = $prodotto['prodotto'];
	    $data = stampa_data($prodotto['data']);
	    $riga_corrente++;
	    switch ($data['mese']) {
	        case 1:
	            if($mese_in_stampa != "Gennaio"){
	                if($mese_in_stampa != ""){
	                    ?>
	                    <tr style="height: 60px">
	    			<td colspan=5><b><?php echo "Totale mensile: " . $totale_mensile?>&euro;</b></td>
	    			</tr>
	                    <?php 
	                }
	               $totale_mensile = $prodotto['prezzo'];
	               $mese_in_stampa = "Gennaio";
	               ?>
	    			<tr style="height: 60px">
	    			<td colspan=5>Mese di&nbsp;
	    			<?php
	               echo "Gennaio " . $data['anno'];
	               ?>
	               </td>
	               </tr>
	               <?php
	            }else{
	                $totale_mensile = $totale_mensile+$prodotto['prezzo'];
	            }
	        break;
	        case 2:
	            if($mese_in_stampa != "Febbraio"){
	                if($mese_in_stampa != ""){
	                    ?>
	                    <tr style="height: 60px">
	    			<td colspan=5><b><?php echo "Totale mensile: " . $totale_mensile?>&euro;</b></td>
	    			</tr>
	                    <?php 
	                }
	                $totale_mensile = $prodotto['prezzo'];
	                $mese_in_stampa = "Febbraio";
	                ?>
	    			<tr style="height: 60px">
	    			<td colspan=5>Mese di&nbsp;
	    			<?php
	                echo "Febbraio " . $data['anno']; 
	                ?>
	               </td>
	               </tr>
	               <?php
	            }else{
	                $totale_mensile = $totale_mensile+$prodotto['prezzo'];
	            }
	            break;
	        case 3:
	            if($mese_in_stampa != "Marzo"){
	                if($mese_in_stampa != ""){
	                    ?>
	                    <tr style="height: 60px">
	    			<td colspan=5><b><?php echo "Totale mensile: " . $totale_mensile?>&euro;</b></td>
	    			</tr>
	                    <?php 
	                }
	                $totale_mensile = $prodotto['prezzo'];
	                $mese_in_stampa = "Marzo";
	                ?>
	    			<tr style="height: 60px">
	    			<td colspan=5>Mese di&nbsp;
	    			<?php
	            echo "Marzo " . $data['anno']; 
	            ?>
	               </td>
	               </tr>
	               <?php
	            }else{
	                $totale_mensile = $totale_mensile+$prodotto['prezzo'];
	            }
	            break;
	        case 4:
	            if($mese_in_stampa != "Aprile"){
	                if($mese_in_stampa != ""){
	                    ?>
	                    <tr style="height: 60px">
	    			<td colspan=5><b><?php echo "Totale mensile: " . $totale_mensile?>&euro;</b></td>
	    			</tr>
	                    <?php 
	                }
	                $totale_mensile = $prodotto['prezzo'];
	                $mese_in_stampa = "Aprile";
	                ?>
	    			<tr style="height: 60px">
	    			<td colspan=5>Mese di&nbsp;
	    			<?php
	            echo "Aprile " . $data['anno']; 
	            ?>
	               </td>
	               </tr>
	               <?php
	            }else{
	                $totale_mensile = $totale_mensile+$prodotto['prezzo'];
	            }
	            break;
	        case 5:
	            if($mese_in_stampa != "Maggio"){
	                if($mese_in_stampa != ""){
	                    ?>
	                    <tr style="height: 60px">
	    			<td colspan=5><b><?php echo "Totale mensile: " . $totale_mensile?>&euro;</b></td>
	    			</tr>
	                    <?php 
	                }
	                $totale_mensile = $prodotto['prezzo'];
	                $mese_in_stampa = "Maggio";
	                ?>
	    			<tr style="height: 60px">
	    			<td colspan=5>Mese di&nbsp;
	    			<?php
	            echo "Maggio " . $data['anno'];
	            ?>
	               </td>
	               </tr>
	               <?php
	            }else{
	                $totale_mensile = $totale_mensile+$prodotto['prezzo'];
	            }
	            break;
	        case 6:
	            if($mese_in_stampa != "Giugno"){
	                if($mese_in_stampa != ""){
	                    ?>
	                    <tr style="height: 60px">
	    			<td colspan=5><b><?php echo "Totale mensile: " . $totale_mensile?>&euro;</b></td>
	    			</tr>
	                    <?php 
	                }
	                $totale_mensile = $prodotto['prezzo'];
	                $mese_in_stampa = "Giugno";
	                ?>
	    			<tr style="height: 60px">
	    			<td colspan=5>Mese di&nbsp;
	    			<?php
	            echo "Giugno " . $data['anno']; 
	            ?>
	               </td>
	               </tr>
	               <?php
	            }else{
	                $totale_mensile = $totale_mensile+$prodotto['prezzo'];
	            }
	            break;
	        case 7:
	            if($mese_in_stampa != "Luglio"){
	                if($mese_in_stampa != ""){
	                    ?>
	                    <tr style="height: 60px">
	    			<td colspan=5><b><?php echo "Totale mensile: " . $totale_mensile?>&euro;</b></td>
	    			</tr>
	                    <?php 
	                }
	                $totale_mensile = $prodotto['prezzo'];
	                $mese_in_stampa = "Luglio";
	                ?>
	    			<tr style="height: 60px">
	    			<td colspan=5>Mese di&nbsp;
	    			<?php
	            echo "Luglio " . $data['anno']; 
	            ?>
	               </td>
	               </tr>
	               <?php
	            }else{
	                $totale_mensile = $totale_mensile+$prodotto['prezzo'];
	            }
	            break;
	        case 8:
	            if($mese_in_stampa != "Agosto"){
	                if($mese_in_stampa != ""){
	                    ?>
	                    <tr style="height: 60px">
	    			<td colspan=5><b><?php echo "Totale mensile: " . $totale_mensile?>&euro;</b></td>
	    			</tr>
	                    <?php 
	                }
	                $totale_mensile = $prodotto['prezzo'];
	                $mese_in_stampa = "Agosto";
	                ?>
	    			<tr style="height: 60px">
	    			<td colspan=5>Mese di&nbsp;
	    			<?php
	            echo "Agosto " . $data['anno'];
	            ?>
	               </td>
	               </tr>
	               <?php
	            }else{
	                $totale_mensile = $totale_mensile+$prodotto['prezzo'];
	            }
	            break;
	        case 9:
	            if($mese_in_stampa != "Settembre"){
	                if($mese_in_stampa != ""){
	                    ?>
	                    <tr style="height: 60px">
	    			<td colspan=5><b><?php echo "Totale mensile: " . $totale_mensile?>&euro;</b></td>
	    			</tr>
	                    <?php 
	                }
	                $totale_mensile = $prodotto['prezzo'];
	                $mese_in_stampa = "Settembre";
	                ?>
	    			<tr style="height: 60px">
	    			<td colspan=5>Mese di&nbsp;
	    			<?php
	            echo "Settembre " . $data['anno']; 
	            ?>
	               </td>
	               </tr>
	               <?php
	            }else{
	                $totale_mensile = $totale_mensile+$prodotto['prezzo'];
	            }
	            break;
	        case 10:
	            if($mese_in_stampa != "Ottobre"){
	                if($mese_in_stampa != ""){
	                    ?>
	                    <tr style="height: 60px">
	    			<td colspan=5><b><?php echo "Totale mensile: " . $totale_mensile?>&euro;</b></td>
	    			</tr>
	                    <?php 
	                }
	                $totale_mensile = $prodotto['prezzo'];
	                $mese_in_stampa = "Ottobre";
	                ?>
	    			<tr style="height: 60px">
	    			<td colspan=5>Mese di&nbsp;
	    			<?php
	            echo "Ottobre " . $data['anno']; 
	            ?>
	               </td>
	               </tr>
	               <?php
	            }else{
	                $totale_mensile = $totale_mensile+$prodotto['prezzo'];
	            }
	            break;
	        case 11:
	            if($mese_in_stampa != "Novembre"){
	                if($mese_in_stampa != ""){
	                    ?>
	                    <tr style="height: 60px">
	    			<td colspan=5><b><?php echo "Totale mensile: " . $totale_mensile?>&euro;</b></td>
	    			</tr>
	                    <?php 
	                }
	                $totale_mensile = $prodotto['prezzo'];
	                $mese_in_stampa = "Novembre";
	                ?>
	    			<tr style="height: 60px">
	    			<td colspan=5>Mese di&nbsp;
	    			<?php
	            echo "Novembre " . $data['anno'];
	            ?>
	               </td>
	               </tr>
	               <?php
	            }else{
	                $totale_mensile = $totale_mensile+$prodotto['prezzo'];
	            }
	            break;
	        case 12:
	            if($mese_in_stampa != "Dicembre"){
	                if($mese_in_stampa != ""){
	                    ?>
	                    <tr style="height: 60px">
	    			<td colspan=5><b><?php echo "Totale mensile: " . $totale_mensile?>&euro;</b></td>
	    			</tr>
	                    <?php 
	                }
	                $totale_mensile = $prodotto['prezzo'];
	                $mese_in_stampa = "Dicembre";
	                ?>
	    			<tr style="height: 60px">
	    			<td colspan=5>Mese di&nbsp;
	    			<?php
	            echo "Dicembre " . $data['anno'];
	            ?>
	               </td>
	               </tr>
	               <?php
	            }else{
	                $totale_mensile = $totale_mensile+$prodotto['prezzo'];
	            }
	            break;
	        
	        default:
	            
	        break;
	    }
	    ?>
	    
	    <?php 
	    switch ($tipo){
	        case 0: //lezione
	           $result2 = $conn->query("SELECT * FROM lezione L,corso C WHERE L.id = '$id' AND L.corso_lez = C.id");
	           $lezione = $result2->fetch_assoc();
	           if($lezione['insegnante'] == $id_insegnante){
	               ?>
	               <tr style="height: 60px">
	               <td><?php echo $lezione['id'];?></td>
	               <td><?php echo $data['giorno'] . "/" . $data['mese'] . "/". $data['anno']; ?></td>
	               <td>Lezione Corso</td>
	               <td><?php echo $lezione['titolo'];?></td>
	               <td><?php echo $lezione['prezzo'];?>&euro;</td>
	               
	               </tr>
	               <?php 
	           }
	        break;
            case 2://esercizio
	            $result2 = $conn->query("SELECT * FROM esercizio E, corso C WHERE E.id = '$id' AND E.corso_ex = C.id");
	            $esercizio = $result2->fetch_assoc();
	            if($esercizio['insegnante'] == $id_insegnante){
	                ?>
	               <tr style="height: 60px">
	               <td><?php echo $esercizio['id'];?></td>
	               <td><?php echo $data['giorno'] . "/" . $data['mese'] . "/". $data['anno']; ?></td>
	               <td>Esercizio Corso</td>
	               <td><?php echo $esercizio['titolo'];?></td>
	               <td><?php echo $esercizio['prezzo'];?>&euro;</td>
	               
	               </tr>
	               <?php 
	           }
	        break;
            case 5://lezione su richiesta
                $result2 = $conn->query("SELECT * FROM richieste_lezioni WHERE id = '$id'");
                $richiesta = $result2->fetch_assoc();
                if($richiesta['insegnante'] == $id_insegnante){
                    ?>
	               <tr style="height: 60px">
	               <td><?php echo $richiesta['id'];?></td>
	               <td><?php echo $data['giorno'] . "/" . $data['mese'] . "/". $data['anno']; ?></td>
	               <td>Lezione su richiesta</td>
	               <td><?php echo $richiesta['titolo'];?></td>
	               <td><?php echo $richiesta['prezzo'];?>&euro;</td>
	               
	               </tr>
	               <?php 
	           }
	        break;
	        default:
	            break;
	       }
	       if($riga_corrente == $numero_righe){
	           ?>
	                    <tr style="height: 60px">
	    			<td colspan=5><b><?php echo "Totale mensile: " . $totale_mensile?>&euro;</b></td>
	    			</tr>
	                    <?php 
	       }
	}
	?>
	<tr>
			<td align="center" id="indietro" colspan=5><strong><a
					href="home-insegnante.html">
					Indietro</a></strong></td>
		</tr>
</table>