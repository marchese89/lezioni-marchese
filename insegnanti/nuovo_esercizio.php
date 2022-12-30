<?php
$corso = $_GET['id_corso'];
?>
<script type="text/javascript">
function cliccaFile(){
    $('#fileuploadPDF_TE').click();
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


function mandaPdfTE(supportAjaxUpload, formID) {
    if (supportAjaxUpload) {
        document.getElementById("progressBar").style.display = 'block';
        
        var file_ = _("fileuploadPDF_TE").files[0];
        
        var formdata_ = new FormData();
        formdata_.append("fileuploadPDF_TE", file_);
        formdata_.append("UploadPDF_TE", "__");
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



function visualizza_pdfTE(img){
    $('#ant_pdfTE').attr('src', img.value);
    
    var reader = new FileReader();
    reader.onload = function (e) {
       $('#ant_pdfTE').attr('src', 'images/miniatura_pdf.png');
    }
    reader.readAsDataURL(img.files[0]);
    document.getElementById("ant_pdfTE").style.opacity = "1";
    var file = img.files[0];  
    var filename = file.name;
    $('#nome_pdfTE').html('&nbsp;&nbsp;&nbsp;' +filename);
    document.getElementById("nome_pdfTE").style.opacity = "1";
}

</script>
<table id="pannello_controllo" >
		
	<tr id="titolo">
		<th>Inserisci nuovo Esercizio</th>
	</tr>


	<tr style="height: 60px">
		<td><label style="font-size: 18px">File traccia Esercizio (immagine o
				pdf)</label></td>
	</tr>
	<tr style="text-align: center">
		<th style="text-align: center; alignment-adjust: central">
           <?php
        if (! isset($_SESSION['percorsoPDF_TE'])) {
            ?>	
	
	<tr align="center">
		<th style="height: 70px; width: 780px; text-align: center"
			align="center">
			<form enctype="multipart/form-data" method="post"
				action="upload/upload.php" id="loadPdfTE">
				<input id="fileuploadPDF_TE" name="fileuploadPDF_TE" type="file"
					accept=".pdf,image/*" class="file_upload"
					onchange="visualizza_pdfTE(this)" /> <input type="button"
					value="Scegli un file" id="btn2" onclick="cliccaFile()" /><span
					style="opacity: 0">_</span> <img id="ant_pdfTE" width="30"
					height="30" style="opacity: 0" /><span
					style="opacity: 0; font-size: 11px; font-stretch: initial"
					id="nome_pdfTE">______</span> <input type="button" value="Upload"
					name="UploadPDFTE"
					onclick="mandaPdfTE(ajaxUploadSupport(),'loadPdfTE')" /><br>
				<progress id="progressBar" value="0" max="100"
					style="width: 300px; display: none; margin-left: auto; margin-right: auto"></progress>
				<br> <span id="status" style="font-size: 12px"></span><br> <span
					id="loaded_n_total" style="font-size: 12px"></span>
			</form>
               
                    <?php
        } else if ($_SESSION['pdfTECaricato'] === "OK") {
            ?>
                    <p>
				<label><font color="green">File traccia esercizio caricato
						correttamente</font></label>
			
			<p>
				<button value="elimina" onclick=location.href="upload/elimina_pdfTE.php?id=-1">elimina</button>
				<p>
				<button onclick=location.href="nuovo-esercizio2-<?php echo $corso;?>.html">Avanti</button>
                        <?php
        } else {
            unset($_SESSION['pdfTECaricato']);
            $motivoErrore = $_SESSION['motivo_errore_pdfTE'];
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
            if ($_SESSION['motivo_errore_pdfTE'] === 'File gi&agrave; presente' && ! empty($_SESSION['pdf_to_deleteTE'])) {
                ?>
                          <button onclick=location.href="upload/elimina_pdfTE.php?id=-1">elimina</button>
                    <?php
            }
        }
        ?>
		
		
		
		</th>
	</tr>
	
	
<tr>
	<td align="center" id="indietro"><strong><a href="corso-ins-<?php echo $corso;?>.html">
				Indietro</a></strong></td>
</tr>
</table>