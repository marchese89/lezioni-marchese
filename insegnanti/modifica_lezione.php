<?php
session_start();
include 'config/mysql-config.php';

?>
<script type="text/javascript">
function cliccaFile(){
    $('#fileuploadPDF_L').click();
}

function completeHandler(event) {
    location.reload();
}
//upload file con ajax
function progressHandler(event) {
    _("loaded_n_total").innerHTML = "Caricati " + event.loaded + " byte di " + event.total;
    var percent = (event.loaded / event.total) * 100;
    _("progressBar").value = Math.round(percent);
    _("status").innerHTML = "caricato al " + Math.round(percent) + "% ... attendere";
}
function completeHandler(event) {
    location.reload();
}
function errorHandler(event) {
    _("status").innerHTML = "Caricamento Fallito";
}
function abortHandler(event) {
    _("status").innerHTML = "Caricamento Annullato";
}


function mandaPdfL(supportAjaxUpload, formID) {
    if (supportAjaxUpload) {
        document.getElementById("progressBar").style.display = 'block';
        
        var file_ = _("fileuploadPDF_L").files[0];
        
        var formdata_ = new FormData();
        formdata_.append("fileuploadPDF_L", file_);
        formdata_.append("UploadPDF_L", "__");
        var ajax_ = new XMLHttpRequest();
        ajax_.upload.addEventListener("progress", progressHandler, false);
        ajax_.addEventListener("load", completeHandler, false);
        ajax_.addEventListener("error", errorHandler, false);
        ajax_.addEventListener("abort", abortHandler, false);
        ajax_.open("POST", "upload/upload.php");
        ajax_.send(formdata_);
        
    } else {
        _(formID).submit();
        
    }
}

function visualizza_pdfL(img){
    $('#ant_pdfL').attr('src', img.value);
    
    var reader = new FileReader();
    reader.onload = function (e) {
       $('#ant_pdfL').attr('src', 'images/miniatura_pdf.png');
    }
    reader.readAsDataURL(img.files[0]);
    document.getElementById("ant_pdfL").style.opacity = "1";
    var file = img.files[0];  
    var filename = file.name;
    $('#nome_pdfL').html('&nbsp;&nbsp;&nbsp;' +filename);
    document.getElementById("nome_pdfL").style.opacity = "1";
}


</script>
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
	<tr style="text-align: center">
		<th style="text-align: center; alignment-adjust: central">
           <?php
        if (! isset($_SESSION['percorsoPDF_L'])) {
            ?>	
	
	
	
	
	
	
	
	<tr align="center">
		<th style="height: 70px; width: 780px; text-align: center"
			align="center">
			<form enctype="multipart/form-data" method="post"
				action="upload/upload.php" id="loadPdfL">
				<input id="fileuploadPDF_L" name="fileuploadPDF_L" type="file"
					accept=".pdf" class="file_upload" onchange="visualizza_pdfL(this)" />
				<input type="button" value="Scegli un file" id="btn2"
					onclick="cliccaFile()" /><span style="opacity: 0">_</span> <img
					id="ant_pdfL" width="30" height="30" style="opacity: 0" /><span
					style="opacity: 0; font-size: 11px; font-stretch: initial"
					id="nome_pdfTS">______</span> <input type="button" value="Upload"
					name="UploadPDFL"
					onclick="mandaPdfL(ajaxUploadSupport(),'loadPdfL')" /><br>
				<progress id="progressBar" value="0" max="100"
					style="width: 300px; display: none; margin-left: auto; margin-right: auto"></progress>
				<br> <span id="status" style="font-size: 12px"></span><br> <span
					id="loaded_n_total" style="font-size: 12px"></span>
			</form>
               
                    <?php
        } else if ($_SESSION['pdfLCaricato'] === "OK") {
            ?>
                    <p>
				<label><font color="green">File Lezione caricato correttamente</font></label>
			
			<p>
				<button value="elimina" onclick=location.href="upload/elimina_pdfL.php">elimina</button>
                        <?php
        } else {
            unset($_SESSION['pdfLCaricato']);
            $motivoErrore = $_SESSION['motivo_errore_pdfL'];
            $toPrint = '';
            switch ($motivoErrore) {
                case 1:
                    $toPrint = 'File troppo grande';
                    break;
                case 2:
                    $toPrint = 'File troppo grande';
                    break;
                case 3:
                    $toPrint = 'Upload parziale';
                    break;
                case 4:
                    $toPrint = 'Nessun file inviato';
                    break;
                case 6:
                    $toPrint = 'Nessuna cartella temporanea';
                    break;
                default:
                    $toPrint = $motivoErrore;
            }
            ?>
                    <label><font color="red">Errore di caricamento: <?php echo $toPrint ?></font></label>
                    <?php
            if ($_SESSION['motivo_errore_pdfL'] === 'File gi&agrave; presente' && ! empty($_SESSION['pdf_to_deleteL'])) {
                ?>
                          <button onclick=location.href="upload/elimina_pdfL.php">elimina</button>
                    <?php
            }
        }
        ?>
		
		
		
		</th>
	</tr>
	<tr style="height: 60px">
		<td><input type="submit" value="Modifica Lezione"></td>
	</tr>
</form>
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
    $result2 = $conn->query("SELECT * FROM lezione WHERE arg_lez='$id_argomento'");
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
