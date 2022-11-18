<?php 
$id = $_GET['id'];
?>
<script type="text/javascript">
function cliccaFile(){
    $('#fileuploadPDF_SL').click();
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


function mandaPdfSL(supportAjaxUpload, formID) {
    if (supportAjaxUpload) {
        document.getElementById("progressBar").style.display = 'block';
        
        var file_ = _("fileuploadPDF_SL").files[0];
        
        var formdata_ = new FormData();
        formdata_.append("fileuploadPDF_SL", file_);
        formdata_.append("UploadPDF_SL", "__");
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



function visualizza_pdfSL(img){
    $('#ant_pdfSL').attr('src', img.value);
    
    var reader = new FileReader();
    reader.onload = function (e) {
       $('#ant_pdfSL').attr('src', 'images/miniatura_pdf.png');
    }
    reader.readAsDataURL(img.files[0]);
    document.getElementById("ant_pdfSL").style.opacity = "1";
    var file = img.files[0];  
    var filename = file.name;
    $('#nome_pdfSL').html('&nbsp;&nbsp;&nbsp;' +filename);
    document.getElementById("nome_pdfSL").style.opacity = "1";
}

</script>
<table id="pannello_controllo" align="center" cellspacing=0 cellpadding=0 width="100%"> 
	<tr id="titolo">
		<th style="height: 60px" align="center"><span
			style="color: #0e83cd; font-size: 24px">Modifica Svolgimento Lezione <?php echo $id;?></span><br></th>
	</tr>
	<tr style="height: 60px">
	<td style="font-size: 18px">
	<label>Scegliere un nuovo file svolgimento</label>
	</td>
	</tr>
	<tr style="text-align: center">
		<th style="text-align: center; alignment-adjust: central">
           <?php
        if (! isset($_SESSION['percorsoPDF_SL'])) {
            ?>	
	
	<tr align="center">
		<th style="height: 70px; width: 780px; text-align: center"
			align="center">
			<form enctype="multipart/form-data" method="post"
				action="upload/upload.php" id="loadPdfSL">
				<input id="fileuploadPDF_SL" name="fileuploadPDF_SL" type="file"
					accept=".pdf,image/*" class="file_upload" onchange="visualizza_pdfSL(this)" />
				<input type="button" value="Scegli un file" id="btn"
					onclick="cliccaFile()" /><span style="opacity: 0">_</span> <img
					id="ant_pdfSL" width="30" height="30" style="opacity: 0" /><span
					style="opacity: 0; font-size: 11px; font-stretch: initial"
					id="nome_pdfSL">______</span> <input type="button" value="Upload"
					name="UploadPDFSL"
					onclick="mandaPdfSL(ajaxUploadSupport(),'loadPdfSL')" /><br>
				<progress id="progressBar" value="0" max="100"
					style="width: 300px; display: none; margin-left: auto; margin-right: auto"></progress>
				<br> <span id="status" style="font-size: 12px"></span><br> <span
					id="loaded_n_total" style="font-size: 12px"></span>
			</form>
               
                    <?php
        } else if ($_SESSION['pdfSLCaricato'] === "OK") {
            ?>
                    <p>
				<label><font color="green">File Richiesta Lezione caricato correttamente</font></label>
			
			<p>
				<button value="elimina" onclick=location.href="upload/elimina_pdfSL.php?id=<?php echo $id;?>">elimina</button>
				<br>
				<br>
				<form  action="insegnanti/modifica_soluzione_lezione.php" method="post">
				<input type="hidden" name="id" value="<?php echo $id;?>"/>
				<input type="submit" value="Invia">
				       </form>
				
                        <?php
        } else {
            unset($_SESSION['pdfSLCaricato']);
            $motivoErrore = $_SESSION['motivo_errore_pdfSL'];
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
            if ($_SESSION['motivo_errore_pdfSL'] === 'File gi&agrave; presente' && ! empty($_SESSION['pdf_to_deleteSL'])) {
                ?>
                          <button onclick=location.href="upload/elimina_pdfSL.php?id=<?php echo $id;?>">elimina</button>
                    <?php
            }
        }
        ?>
		
		</th>
	</tr>
	<tr>
	<tr>
	<td align="center" id="indietro"><strong><a href="visualizza-richiesta-lezione-i-<?php echo $id;?>.html">
				Indietro</a></strong></td>
</tr>
</table>