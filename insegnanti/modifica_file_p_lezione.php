<?php
$corso = $_GET['id_corso'];
?>
<script type="text/javascript">
function cliccaFile(){
    $('#fileuploadPDF_PL').click();
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


function mandaPdfPL(supportAjaxUpload, formID) {
    if (supportAjaxUpload) {
        document.getElementById("progressBar").style.display = 'block';
        
        var file_ = _("fileuploadPDF_PL").files[0];
        
        var formdata_ = new FormData();
        formdata_.append("fileuploadPDF_PL", file_);
        formdata_.append("UploadPDF_PL", "__");
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

function visualizza_pdfPL(img){
    $('#ant_pdfPL').attr('src', img.value);
    
    var reader = new FileReader();
    reader.onload = function (e) {
       $('#ant_pdfPL').attr('src', 'images/miniatura_pdf.png');
    }
    reader.readAsDataURL(img.files[0]);
    document.getElementById("ant_pdfPL").style.opacity = "1";
    var file = img.files[0];  
    var filename = file.name;
    $('#nome_pdfPL').html('&nbsp;&nbsp;&nbsp;' +filename);
    document.getElementById("nome_pdfPL").style.opacity = "1";
}


</script>

<tr style="height: 60px">
	<td><label style="font-size: 18px">Modifica Presentazione Lezione</label></td>
</tr>


	<tr style="text-align: center">
		<th style="text-align: center; alignment-adjust: central">
           <?php
        if (! isset($_SESSION['percorsoPDF_PL'])) {
            ?>	
	
	<tr align="center">
		<th style="height: 70px; width: 780px; text-align: center"
			align="center">
			<form enctype="multipart/form-data" method="post"
				action="upload/upload.php" id="loadPdfPL">
				<input id="fileuploadPDF_PL" name="fileuploadPDF_PL" type="file"
					accept=".pdf,image/*" class="file_upload" onchange="visualizza_pdfPL(this)" />
				<input type="button" value="Scegli un file" id="btn2"
					onclick="cliccaFile()" /><span style="opacity: 0">_</span> <img
					id="ant_pdfPL" width="30" height="30" style="opacity: 0" /><span
					style="opacity: 0; font-size: 11px; font-stretch: initial"
					id="nome_pdfPL">______</span> <input type="button" value="Upload"
					name="UploadPDFPL"
					onclick="mandaPdfPL(ajaxUploadSupport(),'loadPdfPL')" /><br>
				<progress id="progressBar" value="0" max="100"
					style="width: 300px; display: none; margin-left: auto; margin-right: auto"></progress>
				<br> <span id="status" style="font-size: 12px"></span><br> <span
					id="loaded_n_total" style="font-size: 12px"></span>
			</form>
               
                    <?php
        } else if ($_SESSION['pdfPLCaricato'] === "OK") {
            ?>
                    <p>
				<label><font color="green">File Lezione caricato correttamente</font></label>
			
			<p>
				<button value="elimina" onclick=location.href="upload/elimina_pdfPL.php?id_corso=<?php echo $corso;?>&id=<?php echo $_GET['id'];?>&return=1">elimina</button>
                        <?php
        } else {
            unset($_SESSION['pdfPLCaricato']);
            $motivoErrore = $_SESSION['motivo_errore_pdfPL'];
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
            if ($_SESSION['motivo_errore_pdfPL'] === 'File gi&agrave; presente' && ! empty($_SESSION['pdf_to_deletePL'])) {
                ?>
                          <button onclick=location.href="upload/elimina_pdfPL.php?id_corso=<?php echo $corso;?>&id=<?php echo $_GET['id'];?>&return=1">elimina</button>
                    <?php
            }
        }
        ?>
		
		
		
		
		
		</th>
	</tr>
	<tr style="height: 60px">
		<td><button onclick=location.href="insegnanti/modifica-file-p-lezione.php?id_corso=<?php echo $corso;?>&id=<?php echo $_GET['id'];?>">Modifica</button></td>
	</tr>

<tr>
	<td align="center" id="indietro"><strong><a
			href="modifica-lezione-<?php echo $corso;?>-<?php echo $_GET['id'];?>.html"> Indietro</a></strong></td>
</tr>