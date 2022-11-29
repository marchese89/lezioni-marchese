<?php

function esiste($elem,$array):bool{
    for ($i = 0; $i < count($array); $i++) {
        if($array[$i] == $elem){
            return TRUE;
        }
    }
    return FALSE;
}

$id_stud = trovaIdStudente($_SESSION['user'], $conn);


$result = $conn->query("SELECT * FROM ordine WHERE cliente='$id_stud'");
$corsi = array();
while ($ordine = $result->fetch_assoc()) {
    $id_ordine = $ordine['id'];
    $result2 = $conn->query("SELECT * FROM prodotti_ordine WHERE id_ordine='$id_ordine'");
    while ($prodotto = $result2->fetch_assoc()) {
        $tipo_p = $prodotto['tipo'];
        if ($tipo_p == 0) { // lezione
            $c = trovaCorsoLezione($prodotto['prodotto'], $conn);
            if (!esiste($c, $corsi)) {
                array_push($corsi, $c);
                
            }
        }
        if ($tipo_p == 2) { // esercizio
            $c = trovaCorsoEsercizio($prodotto['prodotto'], $conn);
            if (!esiste($c, $corsi)) {
                array_push($corsi, $c);
                
            }
        }
    }
}

?>
<table align="center" width="100%" id="pannello_controllo" cellspacing=0
	cellpadding=0>

	<tr id="titolo">
		<th>Corsi Acquistati</th>
	</tr>
		<?php
//print_r($corsi);
foreach ($corsi as $c) {
    $result = $conn->query("SELECT * FROM corso WHERE id='$c'");
    $corso = $result->fetch_assoc();
    ?>
		    <tr>
		<td>
		<?php 
		$id_mat = trovaMateriaCorso($corso['id'],$conn);
		$result3 = $conn->query("SELECT * FROM materia WHERE id='$id_mat'");
		$mat = $result3->fetch_assoc();
		$id_a_t = $mat['area_tematica'];
		$result4 = $conn->query("SELECT * FROM area_tematica WHERE id='$id_a_t'");
		$at = $result4->fetch_assoc();
		?><label><b><?php echo $at['nome']?></b></label> -> <label><b><?php echo $mat['nome']?></b></label> -> <a href="corso-studente-<?php echo $corso['id'];?>.html"><?php echo $corso['nome']?></a>
		</td>
	</tr>
		    <?php
}
?>

		<tr>
		<td align="center" id="indietro"><strong><a href="home-user.html">
					Indietro</a></strong></td>
	</tr>
</table>