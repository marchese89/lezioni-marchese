<?php
session_start();

?>
<script type="text/javascript">
 function cliccaFile(){
     $('#fileuploadFoto').click();
 }
 function cliccaFile2(){
     $('#fileuploadFotoDI').click();
 }
 function cliccaFile3(){
     $('#fileuploadFotoCF').click();
 }
 function cliccaFile4(){
     $('#fileuploadPDF_TS').click();
 }
 function cliccaFile5(){
     $('#fileuploadPDF_CV').click();
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

 function visualizza_pdfCV(img){
     $('#ant_pdfCV').attr('src', img.value);
     
     var reader = new FileReader();
     reader.onload = function (e) {
        $('#ant_pdfCV').attr('src', 'images/miniatura_pdf.png');
     }
     reader.readAsDataURL(img.files[0]);
     document.getElementById("ant_pdfCV").style.opacity = "1";
     var file = img.files[0];  
     var filename = file.name;
     $('#nome_pdfCV').html('&nbsp;&nbsp;&nbsp;' +filename);
     document.getElementById("nome_pdfCV").style.opacity = "1";
 }
 
 //upload file con ajax
 
function progressHandler1(event) {
    _("loaded_n_total").innerHTML = "Caricati " + event.loaded + " byte di " + event.total;
    var percent = (event.loaded / event.total) * 100;
    _("progressBar").value = Math.round(percent);
    _("status").innerHTML = "caricato al " + Math.round(percent) + "% ... attendere";
}
function completeHandler1(event) {
    location.reload();
}
function errorHandler1(event) {
    _("status").innerHTML = "Caricamento Fallito";
}
function abortHandler1(event) {
    _("status").innerHTML = "Caricamento Annullato";
}

function progressHandler2(event) {
    _("loaded_n_total2").innerHTML = "Caricati " + event.loaded + " byte di " + event.total;
    var percent = (event.loaded / event.total) * 100;
    _("progressBar2").value = Math.round(percent);
    _("status2").innerHTML = "caricato al " + Math.round(percent) + "% ... attendere";
}
function completeHandler2(event) {
    location.reload();
}
function errorHandler2(event) {
    _("status2").innerHTML = "Caricamento Fallito";
}
function abortHandler2(event) {
    _("status2").innerHTML = "Caricamento Annullato";
}

function mandaFoto(supportAjaxUpload, formID) {

    if (supportAjaxUpload) {
        document.getElementById("progressBar").style.display = 'block';

        var file = _("fileuploadFoto").files[0];

        var formdata = new FormData();
        formdata.append("fileuploadFoto", file);
        formdata.append("UploadFoto", "__");
        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progressHandler1, false);
        ajax.addEventListener("load", completeHandler1, false);
        ajax.addEventListener("error", errorHandler1, false);
        ajax.addEventListener("abort", abortHandler1, false);
        ajax.open("POST", "upload/upload.php");
        ajax.send(formdata);


    } else {
        _(formID).submit();

    }
    
}

function mandaFotoDI(supportAjaxUpload, formID) {

    if (supportAjaxUpload) {
        document.getElementById("progressBar").style.display = 'block';

        var file = _("fileuploadFotoDI").files[0];

        var formdata = new FormData();
        formdata.append("fileuploadFotoDI", file);
        formdata.append("UploadFotoDI", "__");
        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progressHandler1, false);
        ajax.addEventListener("load", completeHandler1, false);
        ajax.addEventListener("error", errorHandler1, false);
        ajax.addEventListener("abort", abortHandler1, false);
        ajax.open("POST", "upload/upload.php");
        ajax.send(formdata);


    } else {
        _(formID).submit();

    }
    
}

function mandaFotoCF(supportAjaxUpload, formID) {

    if (supportAjaxUpload) {
        document.getElementById("progressBar").style.display = 'block';

        var file = _("fileuploadFotoCF").files[0];

        var formdata = new FormData();
        formdata.append("fileuploadFotoCF", file);
        formdata.append("UploadFotoCF", "__");
        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progressHandler1, false);
        ajax.addEventListener("load", completeHandler1, false);
        ajax.addEventListener("error", errorHandler1, false);
        ajax.addEventListener("abort", abortHandler1, false);
        ajax.open("POST", "upload/upload.php");
        ajax.send(formdata);


    } else {
        _(formID).submit();

    }
    
}

function mandaPdfTS(supportAjaxUpload, formID) {
    if (supportAjaxUpload) {
        document.getElementById("progressBar2").style.display = 'block';

        var file_ = _("fileuploadPDF_TS").files[0];

        var formdata_ = new FormData();
        formdata_.append("fileuploadPDF_TS", file_);
        formdata_.append("UploadPDF_TS", "__");
        var ajax_ = new XMLHttpRequest();
        ajax_.upload.addEventListener("progress", progressHandler2, false);
        ajax_.addEventListener("load", completeHandler2, false);
        ajax_.addEventListener("error", errorHandler2, false);
        ajax_.addEventListener("abort", abortHandler2, false);
        ajax_.open("POST", "upload/upload.php");
        ajax_.send(formdata_);

    } else {
        _(formID).submit();

    }
}

function mandaPdfCV(supportAjaxUpload, formID) {
    if (supportAjaxUpload) {
        document.getElementById("progressBar2").style.display = 'block';

        var file_ = _("fileuploadPDF_CV").files[0];

        var formdata_ = new FormData();
        formdata_.append("fileuploadPDF_CV", file_);
        formdata_.append("UploadPDF_CV", "__");
        var ajax_ = new XMLHttpRequest();
        ajax_.upload.addEventListener("progress", progressHandler2, false);
        ajax_.addEventListener("load", completeHandler2, false);
        ajax_.addEventListener("error", errorHandler2, false);
        ajax_.addEventListener("abort", abortHandler2, false);
        ajax_.open("POST", "upload/upload.php");
        ajax_.send(formdata_);

    } else {
        _(formID).submit();

    }
}

</script>
<table style="width: 100%; font-size: 28pt; font-family: cursive;">
	<tr style="height: 100px; align-content: center">
		<td><b>Sei un <font color="green">insegnante</font>?
		</b></td>
	</tr>
	<tr style="height: 100px">
		<td><b>Vuoi utilizzare questa piattaforma per trovare nuovi <font
				color="green">allievi</font>?
		</b>
		
		<td></td>
	</tr>
	<tr style="height: 100px">
		<td><b>Invia la tua <font color="green">candidatura</font>! 

</table>
<form
	action="lavora-con-noi2.html"
	method="post">
	<table width="100%" cellspacing="0" cellpadding="0" align="center"
		style="border-collapse: collapse;" RULES=none FRAME=none>
		<tr>
			<th valign="center" height="100"
				style="font-size: 24px; color: #0e83cd;">Iscrizione Insegnante</th>
		</tr>
		<tr>

			<td valign="middle" align="center" height="60" width="98">
				<p style="color: #0e83cd">Nome</p>
				<p>
					<input type="text" id="nome" name="nome" maxlength="45" size="30">
					<script type="text/javascript">
                                    var nome_ = new LiveValidation('nome', {onlyOnSubmit: true});
                                    nome_.add(Validate.Presence);
                                    nome_.add(Validate.SoloTesto);
                                </script>
				</p>
			</td>
		</tr>
		<tr>
			<td valign="middle" align="center" height="60" width="98">
				<p style="color: #0e83cd">Cognome</p>
				<p>
					<input type="text" id="cognome" name="cognome" maxlength="45"
						size="30">
					<script type="text/javascript">
                                    var cognome_ = new LiveValidation('cognome', {onlyOnSubmit: true});
                                    cognome_.add(Validate.Presence);
                                    cognome_.add(Validate.SoloTesto);
                                </script>
				</p>
			</td>
		</tr>
		<tr>
			<td>
				<p style="color: #0e83cd">Codice Fiscale</p>
				<p>
					<input type="text" id="cf" name="cf" maxlength="16" size="30">
					<script type="text/javascript">
                                    var cf_ = new LiveValidation('cf', {onlyOnSubmit: true});
                                    cf_.add(Validate.Presence);
                                    cf_.add(Validate.Length, {is: 16});
                                    cf_.add(Validate.CodiceFiscale);
                                </script>
				</p>
			</td>
		</tr>

		<tr>
			<td valign="middle" align="center" height="60" width="78">
				<p style="color: #0e83cd">Email</p>
				<p>
					<input type="text" name="email1" id="email1" maxlength="45"
						size="30">
					<script type="text/javascript">
                                    var email1 = new LiveValidation('email1', {onlyOnSubmit: true});
                                    email1.add(Validate.Presence);
                                    email1.add(Validate.Email);
                                </script>
				</p>
			</td>
		</tr>
		<tr>
			<td valign="middle" align="center" height="60" width="78">
				<p style="color: #0e83cd">Conferma Email</p>
				<p>
					<input type="text" name="email2" id="email2" maxlength="45"
						size="30">
				</p> <script type="text/javascript">
                                var email2 = new LiveValidation('email2', {onlyOnSubmit: true});
                                email2.add(Validate.Presence);
                                email2.add(Validate.Email);
                                email2.add(Validate.Confirmation, {match: 'email1'});
                            </script>
			</td>

		</tr>


		<tr>
			<td valign="middle" align="center" height="60" width="78">
				<p style="color: #0e83cd">Password</p>
				<p>
					<input type="password" id="pass1" name="pass1" maxlength="45"
						size="20">
					<script type="text/javascript">
                                    var pass1_ = new LiveValidation('pass1', {onlyOnSubmit: true});
                                    pass1_.add(Validate.Presence);
                                </script>
				</p>
			</td>
		</tr>
		<tr>
			<td valign="middle" align="center" height="80" width="78">
				<p style="color: #0e83cd">Conferma Password</p>
				<p>
					<input type="password" name="pass2" id="pass2" maxlength="45"
						size="20">
					<script type="text/javascript">
                                    var pass2_ = new LiveValidation('pass2', {onlyOnSubmit: true});
                                    pass2_.add(Validate.Presence);
                                    pass2_.add(Validate.Confirmation, {match: 'pass1'});
                                </script>
				</p>
			</td>

		</tr>
		<tr align=center>
			<th height="220" align="center">
			<p style="color: #0e83cd">Foto Profilo</p>
                        <?php
                        
                        if (!isset($_SESSION['percorsoFoto'])) {
                           
                            ?>
                <form enctype="multipart/form-data" method="post"
					action="upload/upload.php" id="loadImg">
					<input name="fileuploadFoto" type="file" id="fileuploadFoto"
						accept="image/*" onchange="visualizzaAnteprima(this)"
						class="file_upload" /> <input type="button" value="Scegli un file"
						id="btn" onclick="cliccaFile()" /><span style="opacity: 0">__</span>
					<img id="anteprima" width="100" height="100" style="opacity: 0" /><span
						style="opacity: 0">______</span> <input type="submit"
						value="Upload" name="UploadFoto"
						 onclick="mandaFoto(ajaxUploadSupport(),'loadImg')"/>
				</form> <br> <progress id="progressBar" value="0" max="100"
					style="width: 300px; display: none"></progress><br> <span
				id="status" style="font-size: 12px"></span><br> <span
				id="loaded_n_total" style="font-size: 12px"></span>
                    <?php
                        } else if ($_SESSION['fotoCaricata'] === "OK") {
                            ?>
                    <img src="<?php if(isset($_SESSION['percorsoFoto'])){ echo $_SESSION['percorsoFoto'];} ?>"
				width="60" height="60"><p> <label><font color="green">Foto caricata
						correttamente</font></label>
                      <p>         
                    <button value="elimina" onclick=location.href="upload/elimina_foto.php">elimina</button>
                   
                        <?php
                            
                        } else {
                            unset($_SESSION['fotoCaricata']);
                            $motivoErrore = $_SESSION['motivo_errore_icona'];
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
                            if ($_SESSION['motivo_errore_icona'] === 'File gi&agrave; presente') {
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
		<tr align=center>
			<th height="220" align="center">
			<p style="color: #0e83cd">Documento d'identità (immagine)</p>
                        <?php
                        
                        if (!isset($_SESSION['percorsoFotoDI'])) {
                           
                            ?>
                <form enctype="multipart/form-data" method="post"
					action="upload/upload.php" id="loadImgDI">
					<input name="fileuploadFotoDI" type="file" id="fileuploadFotoDI"
						accept="image/*" onchange="visualizzaAnteprima(this)"
						class="file_upload" /> <input type="button" value="Scegli un file"
						id="btn" onclick="cliccaFile2()" /><span style="opacity: 0">__</span>
					<img id="anteprima" width="100" height="100" style="opacity: 0" /><span
						style="opacity: 0">______</span> <input type="submit"
						value="Upload" name="UploadFotoDI"
						 onclick="mandaFotoDI(ajaxUploadSupport(),'loadImgDI')"/>
				</form> <br> <progress id="progressBar" value="0" max="100"
					style="width: 300px; display: none"></progress><br> <span
				id="status" style="font-size: 12px"></span><br> <span
				id="loaded_n_total" style="font-size: 12px"></span>
                    <?php
                        } else if ($_SESSION['fotoDICaricata'] === "OK") {
                            ?>
                    <img src="<?php if(isset($_SESSION['percorsoFotoDI'])){ echo $_SESSION['percorsoFotoDI'];} ?>"
				width="60" height="60"><p> <label><font color="green">Foto caricata
						correttamente</font></label>
                      <p>         
                    <button value="elimina" onclick=location.href="upload/elimina_fotoDI.php">elimina</button>
                   
                        <?php
                            
                        } else {
                            unset($_SESSION['fotoDICaricata']);
                            $motivoErrore = $_SESSION['motivo_errore_DI'];
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
                            if ($_SESSION['motivo_errore_DI'] === 'File gi&agrave; presente') {
                                if (! empty($_SESSION['to_deleteDI'])) {
                                    ?>
                            <button onclick=location.href="upload/elimina_fotoDI.php">elimina</button>
                            <?php
                                }
                            }
                           
                        }
                        ?>
                </th>
		</tr>
		<tr align=center>
			<th height="220" align="center">
			<p style="color: #0e83cd">Codice fiscale (immagine)</p>
                        <?php
                        
                        if (!isset($_SESSION['percorsoFotoCF'])) {
                           
                            ?>
                <form enctype="multipart/form-data" method="post"
					action="upload/upload.php" id="loadImgCF">
					<input name="fileuploadFotoCF" type="file" id="fileuploadFotoCF"
						accept="image/*" onchange="visualizzaAnteprima(this)"
						class="file_upload" /> <input type="button" value="Scegli un file"
						id="btn" onclick="cliccaFile3()" /><span style="opacity: 0">__</span>
					<img id="anteprima" width="100" height="100" style="opacity: 0" /><span
						style="opacity: 0">______</span> <input type="submit"
						value="Upload" name="UploadFoto"
						 onclick="mandaFotoCF(ajaxUploadSupport(),'loadImg')"/>
				</form> <br> <progress id="progressBar" value="0" max="100"
					style="width: 300px; display: none"></progress><br> <span
				id="status" style="font-size: 12px"></span><br> <span
				id="loaded_n_total" style="font-size: 12px"></span>
                    <?php
                        } else if ($_SESSION['fotoCFCaricata'] === "OK") {
                            ?>
                    <img src="<?php if(isset($_SESSION['percorsoFotoCF'])){ echo $_SESSION['percorsoFotoCF'];} ?>"
				width="60" height="60"><p> <label><font color="green">Foto caricata
						correttamente</font></label>
                      <p>         
                    <button value="elimina" onclick=location.href="upload/elimina_fotoCF.php">elimina</button>
                   
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
		</tr>
<tr style="text-align: center">
    <th style="text-align: center;alignment-adjust: central" >
           <?php 
           if(!isset($_SESSION['percorsoPDF_TS'])){
           ?>
        
                <tr align="center"><th height="70" align="center">
                        <label style="color: #0e83cd">Titolo di studio (pdf)</label></th></tr>
                <tr align="center">
                    <th style="height: 70px;width: 780px;text-align: center" align="center">
                    <form  enctype="multipart/form-data" method="post" action="upload/upload.php" id="loadPdfTS">
                        <input id="fileuploadPDF_TS" name="fileuploadPDF_TS" type="file" accept=".pdf" class="file_upload" onchange="visualizza_pdfTS(this)" />
                        <input type="button" value="Scegli un file" id="btn2" onclick="cliccaFile4()"/><span style="opacity: 0">_</span>
                        <img id="ant_pdfTS" width="30" height="30" style="opacity: 0"/><span style="opacity: 0;font-size: 11px;font-stretch: initial" id="nome_pdfTS">______</span>
                        <input type="button" value="Upload" name="UploadPDF" onclick="mandaPdfTS(ajaxUploadSupport(),'loadPdfTS')"/><br>
                <progress id="progressBar2" value="0" max="100" style="width:300px;display: none;margin-left: auto;margin-right: auto"></progress><br>
                <span id="status2" style="font-size: 12px"></span><br>
                <span id="loaded_n_total2" style="font-size: 12px"></span>
                    </form>
               
                    <?php
           } else if($_SESSION['pdfTSCaricato'] === "OK")  {
                    ?>
                    <label><font color="green">File Titolo di Studio caricato correttamente</font></label>
                        <p>
                    <button value="elimina" onclick=location.href="upload/elimina_pdfTS.php">elimina</button>
                        <?php
                } else {
                    unset($_SESSION['pdfTSCaricato']);
                    $motivoErrore = $_SESSION['motivo_errore_pdfTS'];
                    $toPrint = '';
                    switch ($motivoErrore) {
                        case 1: $toPrint = 'File troppo grande';
                            break;
                        case 2: $toPrint = 'File troppo grande';
                            break;
                        case 3: $toPrint = 'Upload parziale';
                            break;
                        case 4: $toPrint = 'Nessun file inviato';
                            break;
                        case 6: $toPrint = 'Nessuna cartella temporanea';
                            break;
                        default : $toPrint = $motivoErrore;
                    }
                    ?>
                    <label><font color="red">Errore di caricamento: <?php echo $toPrint ?></font></label>
                    <?php
                        if($_SESSION['motivo_errore_pdfTS'] === 'File gi&agrave; presente' && !empty($_SESSION['pdf_to_deleteTS'])){
                    ?>
                          <button onclick=location.href="upload/elimina_pdfTS.php">elimina</button>
                    <?php
                          
                        }
                   
                        
                }
                ?>
                </th>
                </tr>
               
<tr style="text-align: center">
    <th style="text-align: center;alignment-adjust: central" >
            <?php 
            if(!isset($_SESSION['percorsoPDF_CV'])){
            ?>
                <tr align="center"><th height="70" align="center">
                        <label style="color: #0e83cd">Curriculum Vitae (pdf)</label></th></tr>
                <tr align="center">
                    <th style="height: 70px;width: 780px;text-align: center" align="center">
                        
                    <form  enctype="multipart/form-data" method="post" action="upload/upload.php" id="loadPdfCV">
                        <input id="fileuploadPDF_CV" name="fileuploadPDF_CV" type="file" accept=".pdf" class="file_upload" onchange="visualizza_pdfCV(this)" />
                        <input type="button" value="Scegli un file" id="btn2" onclick="cliccaFile5()"/><span style="opacity: 0">_</span>
                        <img id="ant_pdfCV" width="30" height="30" style="opacity: 0"/><span style="opacity: 0;font-size: 11px;font-stretch: initial" id="nome_pdfCV">______</span>
                        <input type="button" value="Upload" name="UploadPDF" onclick="mandaPdfCV(ajaxUploadSupport(),'loadPdfVol')"/><br>
                <progress id="progressBar2" value="0" max="100" style="width:300px;display: none;margin-left: auto;margin-right: auto"></progress><br>
                <span id="status2" style="font-size: 12px"></span><br>
                <span id="loaded_n_total2" style="font-size: 12px"></span>
                    </form>
               
                    <?php
            } else if (isset($_SESSION['pdfCVCaricato']) && $_SESSION['pdfCVCaricato'] === "OK") {
                    ?>
                    <label><font color="green">File caricato correttamente</font></label>
                    <p>
                    <button value="elimina" onclick=location.href="upload/elimina_pdfCV.php">elimina</button>
                        
                        <?php
                    
                } else {
                    unset($_SESSION['pdfCVCaricato']);
                    $motivoErrore = $_SESSION['motivo_errore_pdfCV'];
                    $toPrint = '';
                    switch ($motivoErrore) {
                        case 1: $toPrint = 'File troppo grande';
                            break;
                        case 2: $toPrint = 'File troppo grande';
                            break;
                        case 3: $toPrint = 'Upload parziale';
                            break;
                        case 4: $toPrint = 'Nessun file inviato';
                            break;
                        case 6: $toPrint = 'Nessuna cartella temporanea';
                            break;
                        default : $toPrint = $motivoErrore;
                    }
                    ?>
                    <label><font color="red">Errore di caricamento: <?php echo $toPrint ?></font></label>
                    <?php
                        if($_SESSION['motivo_errore_pdfCV'] === 'File gi&agrave; presente' && !empty($_SESSION['pdf_to_deleteCV'])){
                    ?>
                          <button onclick=location.href="upload/elimina_pdfCV.php">elimina</button>
                    <?php
                          
                        }
                        
                }
                ?>
                </th>
                </tr>
		<tr>
			<th colspan="2" height="130px" style="color: #0e83cd">Informativa sul
				trattamento dei dati personali<br> <textarea rows="8" cols="40"
					disabled>Ai sensi dell'articolo 13 del D.lgs n.196/2003, Le/Vi forniamo le seguenti informazioni:
1. I dati personali da Lei/Voi forniti o acquisiti nell&apos;ambito della nostra attivit&agrave; saranno oggetto di trattamento improntato ai principi di correttezza, liceit&agrave;, trasparenza e di tutela della Sua/Vostra riservatezza e dei Suoi/Vostri diritti.
2. Il trattamento di tali dati personali sar&agrave; finalizzato agli adempimenti degli obblighi contrattuali o derivanti da incarico conferito dall&apos;interessato ed in particolare all&apos;invio telematico di ulteriori informazioni commerciali e materiale pubblicitario sulle novit&agrave; dei prodotti dei titolari di questo sito o eventuali fatture.
3. Il trattamento potr&agrave; essere effettuato anche con l&apos;ausilio di strumenti elettronici con modalit&agrave; idonee a garantire la sicurezza e riservatezza dei dati.
4. Il conferimento dei dati &egrave; obbligatorio. L&apos;eventuale rifiuto a fornirci, in tutto o in parte, i Suoi/Vostri dati personali o l&apos;autorizzazione al trattamento implica l&apos;impossibilit&agrave; di iscriversi al sito.
5. I dati potranno essere comunicati, esclusivamente per le finalit&agrave; sopra indicate, a soggetti determinati al fine di adempiere agli obblighi di cui sopra. Altri soggetti potrebbero venire a conoscenza dei dati in qualit&agrave; di responsabili o incaricati del trattamento o in qualit&agrave; di gestori e manutentori del sito stesso. In nessun caso i dati personali trattati saranno oggetto di diffusione.
7. Il titolare del trattamento dei dati personali &egrave; Cosmo Damiano Umbrello con sede in Via Basilio Bertucci, 1 - 89822 Simbario VV
Il responsabile del trattamento dei dati personali &egrave; Cosmo Damiano Umbrello
8. Al titolare del trattamento o al responsabile Lei/Voi potr&agrave; rivolgersi per far valere i Suoi diritti, cos&igrave; come previsto dall&apos;articolo 7 del D.lgs n.196/2003, che per Sua/Vostra comodit&agrave; riproduciamo integralmente:
Art. 7 Diritto di accesso ai dati personali ed altri diritti

1. L&apos;interessato ha diritto di ottenere la conferma dell&apos;esistenza o meno di dati personali che lo riguardano, anche se non ancora registrati, e la loro comunicazione in forma intelligibile.
2. L&apos;interessato ha diritto di ottenere l&apos;indicazione:
a) dell&apos;origine dei dati personali;
b) delle finalit&agrave; e modalit&agrave; del trattamento;
c) della logica applicata in caso di trattamento effettuato con l&apos;ausilio di strumenti elettronici;
d) degli estremi identificativi del titolare, dei responsabili e del rappresentante designato ai sensi dell&apos;articolo 5, comma 2;
e) dei soggetti o delle categorie di soggetti ai quali i dati personali possono essere comunicati o che possono venirne a conoscenza in qualit&agrave; di rappresentante designato nel territorio dello Stato, di responsabili o incaricati.

3. L&apos;interessato ha diritto di ottenere:
a) l&apos;aggiornamento, la rettificazione ovvero, quando vi ha interesse, l&apos;integrazione dei dati;
b) la cancellazione, la trasformazione in forma anonima o il blocco dei dati trattati in violazione di legge, compresi quelli di cui non &egrave; necessaria la conservazione in relazione agli scopi per i quali i dati sono stati raccolti o successivamente trattati;
c) l&apos;attestazione che le operazioni di cui alle lettere a) e b) sono state portate a conoscenza, anche per quanto riguarda il loro contenuto, di coloro ai quali i dati sono stati comunicati o diffusi, eccettuato il caso in cui tale adempimento si rivela impossibile o comporta un impiego di mezzi manifestamente sproporzionato rispetto al diritto tutelato.

4. L&apos;interessato ha diritto di opporsi, in tutto o in parte:
a) per motivi legittimi al trattamento dei dati personali che lo riguardano, ancorch&eacute; pertinenti allo scopo della raccolta;
b) al trattamento di dati personali che lo riguardano a fini di invio di materiale pubblicitario o di vendita diretta o per il compimento di ricerche di mercato o di comunicazione commerciali
                            </textarea>

			</th>
		</tr>
		<tr>
			<th colspan="2" height="40px" style="color: #0e83cd">Ho letto
				l'informativa <input type="checkbox" style="font-size: x-large">
				&nbsp; <script type="text/javascript">
                                    var info_ = new LiveValidation('info', {onlyOnSubmit: true});
                                    info_.add(Validate.Acceptance);
                                </script>
			</th>
		</tr>
		<tr>
			<td colspan="2" align="center" height="70px">
				<p>
					<input type="submit" class="submit" name="iscrizione"
						value="Conferma">
				</p> <br>
				<p>
			
			</td>

		</tr>
	</table>
</form>


