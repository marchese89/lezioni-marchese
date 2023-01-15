<?php
$mat = $_GET['mat'];
$at = $_GET['at'];
?>
<script type="text/javascript">
function cliccaFile(){
    $('#fileuploadPDF_RL').click();
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


function mandaPdfRL(supportAjaxUpload, formID) {
    if (supportAjaxUpload) {
        document.getElementById("progressBar").style.display = 'block';
        
        var file_ = _("fileuploadPDF_RL").files[0];
        
        var formdata_ = new FormData();
        formdata_.append("fileuploadPDF_RL", file_);
        formdata_.append("UploadPDF_RL", "__");
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



function visualizza_pdfRL(img){
    $('#ant_pdfRL').attr('src', img.value);
    
    var reader = new FileReader();
    reader.onload = function (e) {
       $('#ant_pdfRL').attr('src', 'images/miniatura_pdf.png');
    }
    reader.readAsDataURL(img.files[0]);
    document.getElementById("ant_pdfRL").style.opacity = "1";
    var file = img.files[0];  
    var filename = file.name;
    $('#nome_pdfRL').html('&nbsp;&nbsp;&nbsp;' +filename);
    document.getElementById("nome_pdfRL").style.opacity = "1";
}


</script>
<table id="pannello_controllo">
	<tr id="titolo">
		<th colspan="5">File Richiesta</th>
	</tr>
	
			<tr style="text-align: center">
		<th style="text-align: center; alignment-adjust: central">
           <?php
        if (! isset($_SESSION['percorsoPDF_RL'])) {
            ?>	
	
	<tr align="center">
		<th style="height: 70px; text-align: center"
			align="center">
			<form enctype="multipart/form-data" method="post"
				action="upload/upload.php" id="loadPdfRL">
				<input id="fileuploadPDF_RL" name="fileuploadPDF_RL" type="file"
					accept=".pdf,image/*" class="file_upload" onchange="visualizza_pdfRL(this)" />
				<input type="button" value="Scegli un file" id="btn2"
					onclick="cliccaFile()" /><span style="opacity: 0">_</span> <img
					id="ant_pdfRL" width="30" height="30" style="opacity: 0" /><span
					style="opacity: 0; font-size: 11px; font-stretch: initial"
					id="nome_pdfRL">______</span> <input type="button" value="Upload"
					name="UploadPDFRL"
					onclick="mandaPdfRL(ajaxUploadSupport(),'loadPdfRL')" /><br>
				<progress id="progressBar" value="0" max="100"
					style="width: 300px; display: none; margin-left: auto; margin-right: auto"></progress>
				<br> <span id="status" style="font-size: 12px"></span><br> <span
					id="loaded_n_total" style="font-size: 12px"></span>
			</form>
               
                    <?php
        } else if ($_SESSION['pdfRLCaricato'] === "OK") {
            ?>
                    <p>
				<label><font color="green">File Richiesta Lezione caricato correttamente</font></label>
			
			<p>
				<button value="elimina" onclick=location.href="upload/elimina_pdfRL.php">elimina</button>
				<p>
				
					<tr style="height: 120px">
	<td>
	<form action="studenti/carica-richiesta-lezione.php" method="post">
	<input type="hidden" name="id_ins" value="<?php echo $id_ins;?>">
	<label>Titolo Lezione </label><input type="text" id="titolo_l"
		name="titolo_l" maxlength="45" size="30">
	<script type="text/javascript">
                                    var titolo_l_ = new LiveValidation('titolo_l', {onlyOnSubmit: true});
                                    titolo_l_.add(Validate.Presence);
                                    titolo_l_.add(Validate.SoloTesto);
                                </script>
	<br> <br> <input type="submit" value="Invia Richiesta">
</form>
	</td>
	</tr>
				
				
                        <?php
        } else {
            unset($_SESSION['pdfRLCaricato']);
            $motivoErrore = $_SESSION['motivo_errore_pdfRL'];
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
            if ($_SESSION['motivo_errore_pdfRL'] === 'File gi&agrave; presente' && ! empty($_SESSION['pdf_to_deleteRL'])) {
                ?>
                          <button onclick=location.href="upload/elimina_pdfRL.php">elimina</button>
                    <?php
            }
        }
        ?>
		
		
		
		
		</th>
	</tr>
	

<tr>
		<td align="center" id="indietro" colspan="5"><strong><a
				href="richiesta_lezione3-<?php echo $at;?>.html">
					Indietro</a></strong></td>
	</tr>
</table>