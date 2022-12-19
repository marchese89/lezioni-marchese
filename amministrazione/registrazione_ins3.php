<script>
function cliccaFile(){
    $('#fileuploadFotoCF').click();
}
function visualizzaAnteprima(img){
    $('#anteprima').attr('src', img.value);
    
    var reader = new FileReader();
    reader.onload = function (e) {
       $('#anteprima').attr('src', e.target.result);
       }
    reader.readAsDataURL(img.files[0]);
    document.getElementById("anteprima").style.opacity = "1";     
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

function mandaFotoCF(supportAjaxUpload, formID) {

    if (supportAjaxUpload) {
        document.getElementById("progressBar").style.display = 'block';

        var file = _("fileuploadFotoCF").files[0];

        var formdata = new FormData();
        formdata.append("fileuploadFotoCF", file);
        formdata.append("UploadFotoCF", "__");
        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progressHandler, false);
        ajax.addEventListener("load", completeHandler, false);
        ajax.addEventListener("error", errorHandler, false);
        ajax.addEventListener("abort", abortHandler, false);
        ajax.open("POST", "upload/upload.php");
        ajax.send(formdata);


    } else {
        _(formID).submit();

    }
    
}

</script>
<table id="pannello_controllo">
	<tr id="titolo">
		<th>Codice fiscale (immagine)</th>
	</tr>
	<tr align=center>
		<th height="220" align="center">

                        <?php
                        if (! isset($_SESSION['percorsoFotoCF'])) {

                            ?>
                <form enctype="multipart/form-data" method="post"
				action="upload/upload.php" id="loadImgCF">
				<input name="fileuploadFotoCF" type="file" id="fileuploadFotoCF"
					accept="image/*" onchange="visualizzaAnteprima(this)"
					class="file_upload" /> <input type="button" value="Scegli un file"
					id="btn" onclick="cliccaFile()" /><span style="opacity: 0">__</span>
				<img id="anteprima" width="100" height="100" style="opacity: 0" /><span
					style="opacity: 0">______</span> <input type="submit"
					value="Upload" name="UploadFoto"
					onclick="mandaFotoCF(ajaxUploadSupport(),'loadImgCF')" />
			</form> <br> <progress id="progressBar" value="0" max="100"
				style="width: 300px; display: none"></progress><br> <span
			id="status" style="font-size: 12px"></span><br> <span
			id="loaded_n_total" style="font-size: 12px"></span>
                    <?php
                        } else if ($_SESSION['fotoCFCaricata'] === "OK") {
                            ?>
                    <img
			src="<?php if(isset($_SESSION['percorsoFotoCF'])){ echo $_SESSION['percorsoFotoCF'];} ?>"
			width="60" height="60">
		<p>
				<label><font color="green">Foto caricata correttamente</font></label>
			
			<p>
				<button value="elimina" onclick=location.href="upload/elimina_fotoCF.php">elimina</button>
                   <p>
                <input type="button" value="Avanti" onclick=location.href="registrazione-insegnante-4.html">
                        <?php
                        } else {
                            unset($_SESSION['fotoCFCaricata']);
                            $motivoErrore = $_SESSION['motivo_errore_CF'];
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
                            if ($_SESSION['motivo_errore_CF'] === 'File gi&agrave; presente') {
                                if (! empty($_SESSION['to_deleteCF'])) {
                                    ?>
                            <button onclick=location.href="upload/elimina_fotoCF.php">elimina</button>
                            <?php
                                }
                            }
                        }
                        ?>
                
		
		</th>
	</tr>
	<tr>
			<td align="center" id="indietro"><strong><a
					href="registrazione-insegnante-2.html">
					Indietro</a></strong></td>
		</tr>
</table>