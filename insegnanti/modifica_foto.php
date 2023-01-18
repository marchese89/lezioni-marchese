
<script>
function cliccaFile(){
    $('#fileuploadFoto').click();
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


function inviaFile(supportAjaxUpload, formID) {

    if (supportAjaxUpload) {
        document.getElementById("progressBar").style.display = 'block';

        var file = _("fileuploadFoto").files[0];

        var formdata = new FormData();
        formdata.append("fileuploadFoto", file);
        formdata.append("UploadFoto", "__");
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
<tr  id="titolo">
<th>Modifica Foto Profilo</th>
</tr>
	<tr align=center>
		<th height="220" align="center">
                        <?php
                        if (! isset($_SESSION['percorsoFoto'])) {

                            ?>
                <form enctype="multipart/form-data" method="post" action="upload/upload.php" id="loadImg">
				<input name="fileuploadFoto" type="file" id="fileuploadFoto" accept="image/*" 
				onchange="visualizzaAnteprima(this)"class="file_upload" /> 
				<input type="button" value="Scegli un file" id="btn" onclick="cliccaFile()" />
					<span style="opacity: 0">__</span>
				<img id="anteprima" width="100" height="100" style="opacity: 0" />
				<span style="opacity: 0">______</span> 
				<input type="button" value="Upload" name="UploadFoto" onclick="inviaFile(ajaxUploadSupport(),'loadImg')" />
			</form> 
			<br> 
			<progress id="progressBar" value="0" max="100" style="width: 300px; display: none"></progress>
			<br> 
			<span id="status" style="font-size: 12px"></span>
			<br>
			<span id="loaded_n_total" style="font-size: 12px"></span>
                    <?php
                        } else if ($_SESSION['fotoCaricata'] === "OK") {
                            ?>
                    <img
			src="<?php if(isset($_SESSION['percorsoFoto'])){ echo $_SESSION['percorsoFoto'];} ?>"
			width="60" height="60">
		<p>
				<label><font color="green">Foto caricata correttamente</font></label>
			
			<p>
				<button value="elimina" onclick=location.href="upload/elimina_foto.php?ret=1">elimina</button>
				<p>
                 <button value="modifica_foto" onclick=location.href="insegnanti/modifica_foto_ins.php">Modifica Foto</button>          
                   
                        <?php
                        } else {
                            unset($_SESSION['fotoCaricata']);
                            $motivoErrore = $_SESSION['motivo_errore_Foto'];
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
                            if ($_SESSION['motivo_errore_Foto'] === 'File gi&agrave; presente') {
                                if (! empty($_SESSION['to_delete'])) {
                                    ?>
                            <button onclick=location.href="upload/elimina_foto.php">elimina</button>
                            
                            <?php
                                }
                            }
                        }
                        ?>
                
		
		</th>
	</tr>
	<tr>
			<td align="center" id="indietro"><strong><a
					href="modifica-dati-insegnante.html">
					Indietro</a></strong></td>
		</tr>
</table>