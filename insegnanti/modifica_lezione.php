<?php
session_start();
include 'config/mysql-config.php';

?>

<tr style="height: 60px">
	<td><label style="font-size: 18px">Modifica Lezione</label></td>
</tr>
<form action="insegnanti/modifica-lezione.php" method="post">
	<tr style="height: 60px;">

		<td><label>
				
	<?php
$id_lezione = $_GET['id'];

$result0 = $conn->query("SELECT * FROM lezione WHERE id='$id_lezione'");
$lezione = $result0->fetch_assoc();
$id_argomento = $lezione['arg_lez'];
$result1 = $conn->query("SELECT * FROM argomento WHERE id='$id_argomento'");
$argomento = $result1->fetch_assoc();
$id_corso = $argomento['corso_arg'];
$result = $conn->query("SELECT * FROM corso WHERE id='$id_corso'");
$r = $result->fetch_assoc();
$id_mat = $r['materia'];
$result2 = $conn->query("SELECT * FROM materia WHERE id='$id_mat'");
$row2 = $result2->fetch_assoc();
$id_a_t = $row2['area_tematica'];
$result3 = $conn->query("SELECT * FROM area_tematica WHERE id='$id_a_t'");
$row3 = $result3->fetch_assoc();
echo "Area Tematica: " . $row3['nome'] . " - Materia: " . $row2['nome'] . " - Corso: " . $r['nome'] . " - Argomento: " . $argomento['nome'];

?>
	</label> <input type="hidden" name="id"
			value="<?php echo $_GET['id']?>"></td>

	</tr>

	<tr style="height: 60px">
		<td><label>Numero</label><input type="text" name="numero_lezione"
			id="numero_lezione" maxlength="45" size="24" autofocus="true"
			value="<?php echo $lezione['numero'];?>"> <script
				type="text/javascript">
                                    var numero_lezione = new LiveValidation('numero_lezione', {onlyOnSubmit: true});
                                    numero_lezione.add(Validate.Presence);
                                    numero_lezione.add(Validate.soloNumeri);
                                </script></td>
	</tr>

	<tr style="height: 60px">
		<td><label>Titolo</label><input type="text" name="titolo_lezione"
			id="titolo_lezione" maxlength="45" size="24" autofocus="true"
			value="<?php echo $lezione['titolo'];?>"> <script
				type="text/javascript">
                                    var titolo_lezione = new LiveValidation('titolo_lezione', {onlyOnSubmit: true});
                                    titolo_lezione.add(Validate.Presence);
                                    titolo_lezione.add(Validate.TestoEnumeri);
                                </script></td>
	</tr>

	<tr style="height: 60px">
		<td><label>Prezzo</label><input type="text" name="prezzo_lezione"
			id="prezzo_lezione" maxlength="45" size="24" autofocus="true"
			value="<?php echo $lezione['prezzo'];?>"> <b> &euro;</b> <script
				type="text/javascript">
                                    var prezzo_lezione = new LiveValidation('prezzo_lezione', {onlyOnSubmit: true});
                                    prezzo_lezione.add(Validate.Presence);
                                    prezzo_lezione.add(Validate.soloNumeri);
                                </script></td>
	</tr>
	
	<tr style="height: 60px">
		<td><input type="submit" value="Modifica Lezione"></td>
	</tr>
</form>
	<tr style="height: 60px">
	<td><label>Presentazione Lezione</label></td>
	</tr>
	<tr style="height: 60px">
	<td><iframe src="<?php echo $lezione['presentazione'];?>#view=FitH" width="90%" height="800px"></iframe></td>
</tr>
<tr style="height: 60px">
		<td><button class="button" onclick=location.href="modifica-file-p-lezione-<?php echo $id_lezione;?>.html">Modifica Presentazione Lezione</button></td>
	</tr>
	<tr style="height: 60px">
	<td><label>Lezione</label></td>
	</tr>
	<tr style="height: 60px">
	<td><iframe src="<?php echo $lezione['percorso_file'];?>#view=FitH" width="90%" height="800px"></iframe></td>
</tr>
<tr style="height: 60px">
		<td><button class="button" onclick=location.href="modifica-file-lezione-<?php echo $id_lezione;?>.html">Modifica File Lezione</button></td>
	</tr>
<tr style="height: 60px">
	<td><label style="font-size: 18px">Elenco lezioni Corso</label></td>
</tr>
<tr style="height: 60px">
	<td>
		<div id="lezioni_corso">
		<?php

$id_arg = $_GET['id'];

$result0 = $conn->query("SELECT * FROM argomento WHERE id='$id_argomento'");
$arg = $result0->fetch_assoc();
$id_corso = $arg['corso_arg'];
// ORDER BY numero ASC
$result = $conn->query("SELECT * FROM argomento WHERE corso_arg='$id_corso'");

$toPrint = "<br>";

while ($argomento = $result->fetch_assoc()) {
    $id_argomento = $argomento['id'];
    $result2 = $conn->query("SELECT * FROM lezione WHERE arg_lez='$id_argomento' ORDER BY numero ASC");
    while ($lez = $result2->fetch_assoc()) {
        $toPrint = $toPrint . "<label>";
        $toPrint = $toPrint . "(" . $lez['numero'] . ") - " . $argomento['nome'] . " - " . $lez['titolo'] . " - prezzo: " . $lez['prezzo'] . "&euro;";
        $toPrint = $toPrint . '</label>   ';
        $toPrint = $toPrint . "<br><br>";
    }
}
echo $toPrint;
?>
		</div>
	</td>
</tr>
<tr>
	<td align="center" id="indietro"><strong><a href="nuova-lezione.html">
				Indietro</a></strong></td>
</tr>
