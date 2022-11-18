<?php
session_start();
include 'config/mysql-config.php';

?>
<script type="text/javascript">
function cliccaFile(){
    $('#fileuploadPDF_L').click();
}
function cliccaFile2(){
    $('#fileuploadPDF_PL').click();
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

//upload file con ajax
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


function mandaPdfL(supportAjaxUpload, formID) {
    if (supportAjaxUpload) {
        document.getElementById("progressBar").style.display = 'block';
        
        var file_ = _("fileuploadPDF_L").files[0];
        
        var formdata_ = new FormData();
        formdata_.append("fileuploadPDF_L", file_);
        formdata_.append("UploadPDF_L", "__");
        var ajax_ = new XMLHttpRequest();
        ajax_.upload.addEventListener("progress2", progressHandler, false);
        ajax_.addEventListener("load", completeHandler, false);
        ajax_.addEventListener("error", errorHandler, false);
        ajax_.addEventListener("abort", abortHandler, false);
        ajax_.open("POST", "upload/upload.php");
        ajax_.send(formdata_);
        
    } else {
        _(formID).submit();
        
    }
}


function mandaPdfPL(supportAjaxUpload, formID) {
    if (supportAjaxUpload) {
        document.getElementById("progressBar").style.display = 'block';
        
        var file_ = _("fileuploadPDF_PL").files[0];
        
        var formdata_ = new FormData();
        formdata_.append("fileuploadPDF_PL", file_);
        formdata_.append("UploadPDF_PL", "__");
        var ajax_ = new XMLHttpRequest();
        ajax_.upload.addEventListener("progress", progressHandler2, false);
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


function carica_lezioni(id_argomento) {
	  if (id_argomento == "") {
	    document.getElementById("lezioni_corso").innerHTML = "";
	    return;
	  } else {
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	      if (this.readyState == 4 && this.status == 200) {
	        document.getElementById("lezioni_corso").innerHTML = this.responseText;
	      }
	    };
	    xmlhttp.open("GET","richieste_ajax/lezioni_corso.php?id="+id_argomento,true);
	    xmlhttp.send();
	  }
	}
</script>
<tr style="height: 60px">
	<td><label style="font-size: 18px">Inserisci nuova Lezione</label></td>
</tr>
<form action="insegnanti/inserisci_lezione.php" method="post">
	<tr style="height: 60px;">

		<td><label>Area Tematica - Materia - Corso - Argomento</label> <select
			name="argomento" id="argomento" onchange="carica_lezioni(this.value)">
				
	<?php
$email = $_SESSION['user'];

$result0 = $conn->query("SELECT * FROM argomento");
while ($argomento = $result0->fetch_assoc()) {
    $id_corso = $argomento['corso_arg'];
    $result1 = $conn->query("SELECT * FROM corso WHERE id='$id_corso'");
    $corso = $result1->fetch_assoc();
    $id_mat = $corso['materia'];
    $result2 = $conn->query("SELECT * FROM materia WHERE id='$id_mat'");
    $materia = $result2->fetch_assoc();
    $id_a_t = $materia['area_tematica'];
    $result3 = $conn->query("SELECT * FROM area_tematica WHERE id='$id_a_t'");
    $area_tematica = $result3->fetch_assoc();
    ?>
	    <option value="<?php echo $argomento['id'];?>"><?php echo  $area_tematica['nome'] . " - ". $materia['nome']. " - " . $corso['nome'] . " - " . $argomento['nome'];?></option>
	    <?php
}
?>
				
		</select></td>

	</tr>

	<tr style="height: 60px">
		<td><label>Numero</label><input type="text"
			name="numero_lezione" id="numero_lezione" maxlength="45" size="24"
			autofocus="true"> <script type="text/javascript">
                                    var numero_lezione = new LiveValidation('numero_lezione', {onlyOnSubmit: true});
                                    numero_lezione.add(Validate.Presence);
                                    numero_lezione.add(Validate.soloNumeri);
                                </script></td>
	</tr>

	<tr style="height: 60px">
		<td><label>Titolo</label><input type="text"
			name="titolo_lezione" id="titolo_lezione" maxlength="45" size="24"
			autofocus="true"> <script type="text/javascript">
                                    var titolo_lezione = new LiveValidation('titolo_lezione', {onlyOnSubmit: true});
                                    titolo_lezione.add(Validate.Presence);
                                    titolo_lezione.add(Validate.TestoEnumeri);
                                </script></td>
	</tr>

	<tr style="height: 60px">
		<td><label>Prezzo</label><input type="text"
			name="prezzo_lezione" id="prezzo_lezione" maxlength="45" size="24"
			autofocus="true"> <b> &euro;</b> <script type="text/javascript">
                                    var prezzo_lezione = new LiveValidation('prezzo_lezione', {onlyOnSubmit: true});
                                    prezzo_lezione.add(Validate.Presence);
                                    prezzo_lezione.add(Validate.soloNumeri);
                                </script></td>
	</tr>
	<tr style="height: 60px">
		<td><label style="font-size: 18px">File Presentazione Lezione (immagine o
				pdf)</label></td>
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
					onclick="cliccaFile2()" /><span style="opacity: 0">_</span> <img
					id="ant_pdfPL" width="30" height="30" style="opacity: 0" /><span
					style="opacity: 0; font-size: 11px; font-stretch: initial"
					id="nome_pdfPL">______</span> <input type="button" value="Upload"
					name="UploadPDFPL"
					onclick="mandaPdfPL(ajaxUploadSupport(),'loadPdfPL')" /><br>
				<progress id="progressBar2" value="0" max="100"
					style="width: 300px; display: none; margin-left: auto; margin-right: auto"></progress>
				<br> <span id="status2" style="font-size: 12px"></span><br> <span
					id="loaded_n_total2" style="font-size: 12px"></span>
			</form>
               
                    <?php
        } else if ($_SESSION['pdfPLCaricato'] === "OK") {
            ?>
                    <p>
				<label><font color="green">File Presentazione Lezione caricato correttamente</font></label>
			
			<p>
				<button value="elimina" onclick=location.href="upload/elimina_pdfPL.php?id=-1">elimina</button>
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
                          <button onclick=location.href="upload/elimina_pdfPL.php?id=-1">elimina</button>
                    <?php
            }
        }
        ?>
		
		
		
		
		</th>
	</tr>
	<tr style="height: 60px">
		<td><label style="font-size: 18px">File Lezione (immagine o
				pdf)</label></td>
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
					accept=".pdf,image/*" class="file_upload" onchange="visualizza_pdfL(this)" />
				<input type="button" value="Scegli un file" id="btn2"
					onclick="cliccaFile()" /><span style="opacity: 0">_</span> <img
					id="ant_pdfL" width="30" height="30" style="opacity: 0" /><span
					style="opacity: 0; font-size: 11px; font-stretch: initial"
					id="nome_pdfL">______</span> <input type="button" value="Upload"
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
				<button value="elimina" onclick=location.href="upload/elimina_pdfL.php?id=-1">elimina</button>
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
                          <button onclick=location.href="upload/elimina_pdfL.php?id=-1">elimina</button>
                    <?php
            }
        }
        ?>
		
		
		
		
		</th>
	</tr>
	<tr style="height: 60px">
		<td><input type="submit" value="Inserisci Lezione"></td>
	</tr>
</form>
<tr style="height: 60px">
	<td><label style="font-size: 18px">Elenco lezioni Corso</label></td>
</tr>
<tr style="height: 60px">
	<td>
		<div id="lezioni_corso"></div>
	</td>
</tr>
<tr>
	<td align="center" id="indietro"><strong><a href="elenco-corsi.html">
				Indietro</a></strong></td>
</tr>
