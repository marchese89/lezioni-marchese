<script>
function cliccaFile(){
    $('#fileuploadPDF_TS').click();
}

function visualizza_pdfTS(img){
    $('#ant_pdfTS').attr('src', img.value);
    
    var reader = new FileReader();
    reader.onload = function (e) {
       $('#ant_pdfTS').attr('src', 'images/miniatura_pdf.png');
    }
    reader.readAsDataURL(img.files[0]);
    document.getElementById("ant_pdfTS").style.opacity = "1";
    var file = img.files[0];  
    var filename = file.name;
    $('#nome_pdfTS').html('&nbsp;&nbsp;&nbsp;' +filename);
    document.getElementById("nome_pdfTS").style.opacity = "1";
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

function mandaPdfTS(supportAjaxUpload, formID) {
    if (supportAjaxUpload) {
        document.getElementById("progressBar").style.display = 'block';

        var file_ = _("fileuploadPDF_TS").files[0];

        var formdata_ = new FormData();
        formdata_.append("fileuploadPDF_TS", file_);
        formdata_.append("UploadPDF_TS", "__");
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
</script>
<table id="pannello_controllo">
	<tr id="titolo">
		<th>Titolo di studio (pdf)</th>
	</tr>
	<tr style="text-align: center">
		<th style="text-align: center; alignment-adjust: central">
           <?php
        if (! isset($_SESSION['percorsoPDF_TS'])) {
            ?>
        
                

	
	
	<tr align="center">
		<th style="height: 70px; width: 780px; text-align: center"
			align="center">
			<form enctype="multipart/form-data" method="post"
				action="upload/upload.php" id="loadPdfTS">
				<input id="fileuploadPDF_TS" name="fileuploadPDF_TS" type="file"
					accept=".pdf" class="file_upload" onchange="visualizza_pdfTS(this)" />
				<input type="button" value="Scegli un file" id="btn2"
					onclick="cliccaFile()" /><span style="opacity: 0">_</span> <img
					id="ant_pdfTS" width="30" height="30" style="opacity: 0" /><span
					style="opacity: 0; font-size: 11px; font-stretch: initial"
					id="nome_pdfTS">______</span> <input type="button" value="Upload"
					name="UploadPDF"
					onclick="mandaPdfTS(ajaxUploadSupport(),'loadPdfTS')" /><br>
				<progress id="progressBar" value="0" max="100"
					style="width: 300px; display: none; margin-left: auto; margin-right: auto"></progress>
				<br> <span id="status" style="font-size: 12px"></span><br> <span
					id="loaded_n_total" style="font-size: 12px"></span>
			</form>
               
                    <?php
        } else if ($_SESSION['pdfTSCaricato'] === "OK") {
            ?>
            <p>
                    <label><font color="green">File Titolo di Studio
					caricato correttamente</font></label>
			<p>
				<button value="elimina" onclick=location.href="upload/elimina_pdfTS.php">elimina</button>
				 <p>
                <input type="button" value="Avanti" onclick=location.href="registrazione-insegnante-5.html">
                        <?php
        } else {
            unset($_SESSION['pdfTSCaricato']);
            $motivoErrore = $_SESSION['motivo_errore_pdfTS'];
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
            if ($_SESSION['motivo_errore_pdfTS'] === 'File gi&agrave; presente' && ! empty($_SESSION['pdf_to_deleteTS'])) {
                ?>
                          <button onclick=location.href="upload/elimina_pdfTS.php">elimina</button>
                    <?php
            }
        }
        ?>
                
	
	
		
		</th>
	</tr>
		<tr>
			<td align="center" id="indietro"><strong><a
					href="registrazione-insegnante-3.html">
					Indietro</a></strong></td>
		</tr>
</table>