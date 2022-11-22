<?php
session_start();
include 'config/mysql-config.php';

?>
<script type="text/javascript">
function cliccaFile(){
    $('#fileuploadPDF_TE').click();
}
function cliccaFile2(){
    $('#fileuploadPDF_SE').click();
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

function mandaPdfSE(supportAjaxUpload, formID) {
    if (supportAjaxUpload) {
        document.getElementById("progressBar").style.display = 'block';
        
        var file_ = _("fileuploadPDF_SE").files[0];
        
        var formdata_ = new FormData();
        formdata_.append("fileuploadPDF_SE", file_);
        formdata_.append("UploadPDF_SE", "__");
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

function visualizza_pdfSE(img){
    $('#ant_pdfSE').attr('src', img.value);
    
    var reader = new FileReader();
    reader.onload = function (e) {
       $('#ant_pdfSE').attr('src', 'images/miniatura_pdf.png');
    }
    reader.readAsDataURL(img.files[0]);
    document.getElementById("ant_pdfSE").style.opacity = "1";
    var file = img.files[0];  
    var filename = file.name;
    $('#nome_pdfSE').html('&nbsp;&nbsp;&nbsp;' +filename);
    document.getElementById("nome_pdfSE").style.opacity = "1";
}

function carica_esercizi(id_argomento) {
	  if (id_argomento == "") {
	    document.getElementById("esercizi_corso").innerHTML = "";
	    return;
	  } else {
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	      if (this.readyState == 4 && this.status == 200) {
	        document.getElementById("esercizi_corso").innerHTML = this.responseText;
	      }
	    };
	    xmlhttp.open("GET","richieste_ajax/esercizi_corso.php?id="+id_argomento,true);
	    xmlhttp.send();
	  }
	}

function carica_materia(id_area_tem) {
	  if (id_area_tem == "") {
	    document.getElementById("materia").innerHTML = "";
	    return;
	  } else {
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	      if (this.readyState == 4 && this.status == 200) {
	        document.getElementById("materia").innerHTML = this.responseText;
	      }
	    };
	    xmlhttp.open("GET","richieste_ajax/carica_materia.php?id="+id_area_tem,true);
	    xmlhttp.send();
	  }
	}
function carica_corso(id_materia) {
	  if (id_materia == "") {
	    document.getElementById("corso").innerHTML = "";
	    return;
	  } else {
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	      if (this.readyState == 4 && this.status == 200) {
	        document.getElementById("corso").innerHTML = this.responseText;
	      }
	    };
	    xmlhttp.open("GET","richieste_ajax/carica_corso.php?id="+id_materia,true);
	    xmlhttp.send();
	  }
	}


function aggiungi_corso(){
	var form = document.getElementById('form_ex');
    var input = document.createElement('input');
    input.setAttribute('name', 'corso');
    input.setAttribute('value', document.getElementById('select_corso').value);
    input.setAttribute('type', 'hidden');
    form.appendChild(input);
}
</script>
<tr style="height: 60px">
	<td><label style="font-size: 18px">Inserisci nuovo Esercizio (Caricare prima i file!)</label></td>
</tr>
<form action="insegnanti/inserisci_esercizio.php" method="post" onsubmit="aggiungi_corso()" id="form_ex">

	<tr style="height: 60px;">

		<td><label>Area Tematica</label> <select name="area_tematica"
			id="area_tematica" onchange="carica_materia(this.value)">
				<option value="0"></option>
				
	<?php
$email = $_SESSION['user'];

$result0 = $conn->query("SELECT * FROM area_tematica");
while ($area_tematica = $result0->fetch_assoc()) {

    ?>
	    <option value="<?php echo $area_tematica['id'];?>"><?php echo  $area_tematica['nome'];?></option>
				
				
	    <?php
}
?>
				
		
		
		</select></td>

	</tr>
	<tr style="height: 60px;">
		<td>
			<div id="materia"></div>
		</td>
	</tr>
	<tr style="height: 60px;">
		<td>
			<div id="corso"></div></td>
	</tr>


	<tr style="height: 60px">
		<td><label>Titolo</label><input type="text" name="titolo_esercizio"
			id="titolo_esercizio" maxlength="45" size="24" autofocus="true"> <script
				type="text/javascript">
                                    var titolo_esercizio = new LiveValidation('titolo_lezione', {onlyOnSubmit: true});
                                    titolo_esercizio.add(Validate.Presence);
                                    titolo_esercizio.add(Validate.TestoEnumeri);
                                </script></td>
	</tr>

	<tr style="height: 60px">
		<td><label>Prezzo</label><input type="text" name="prezzo_esercizio"
			id="prezzo_esercizio" maxlength="45" size="24" autofocus="true"> <b>
				&euro;</b> <script type="text/javascript">
                                    var prezzo_esercizio = new LiveValidation('prezzo_esercizio', {onlyOnSubmit: true});
                                    prezzo_esercizio.add(Validate.Presence);
                                    prezzo_esercizio.add(Validate.soloNumeri);
                                </script></td>
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
				<button value="elimina" onclick=location.href="upload/elimina_pdfTE.php">elimina</button>
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
                          <button onclick=location.href="upload/elimina_pdfTE.php">elimina</button>
                    <?php
            }
        }
        ?>
		
		
		
		</th>
	</tr>
	<tr style="height: 60px">
		<td><label style="font-size: 18px">File Svolgimento Esercizio
				(immagine o pdf)</label></td>
	</tr>
	<tr style="text-align: center">
		<th style="text-align: center; alignment-adjust: central">
           <?php
        if (! isset($_SESSION['percorsoPDF_SE'])) {
            ?>	
	
	
	
	
	<tr align="center">
		<th style="height: 70px; width: 780px; text-align: center"
			align="center">
			<form enctype="multipart/form-data" method="post"
				action="upload/upload.php" id="loadPdfSE">
				<input id="fileuploadPDF_SE" name="fileuploadPDF_SE" type="file"
					accept=".pdf,image/*" class="file_upload"
					onchange="visualizza_pdfSE(this)" /> <input type="button"
					value="Scegli un file" id="btn2" onclick="cliccaFile2()" /><span
					style="opacity: 0">_</span> <img id="ant_pdfSE" width="30"
					height="30" style="opacity: 0" /><span
					style="opacity: 0; font-size: 11px; font-stretch: initial"
					id="nome_pdfSE">______</span> <input type="button" value="Upload"
					name="UploadPDFSE"
					onclick="mandaPdfSE(ajaxUploadSupport(),'loadPdfSE')" /><br>
				<progress id="progressBar" value="0" max="100"
					style="width: 300px; display: none; margin-left: auto; margin-right: auto"></progress>
				<br> <span id="status" style="font-size: 12px"></span><br> <span
					id="loaded_n_total" style="font-size: 12px"></span>
			</form>
               
                    <?php
        } else if ($_SESSION['pdfSECaricato'] === "OK") {
            ?>
                    <p>
				<label><font color="green">File svolgimento esercizio caricato
						correttamente</font></label>
			
			<p>
				<button value="elimina" onclick=location.href="upload/elimina_pdfSE.php">elimina</button>
                        <?php
        } else {
            unset($_SESSION['pdfSECaricato']);
            $motivoErrore = $_SESSION['motivo_errore_pdfSE'];
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
            if ($_SESSION['motivo_errore_pdfSE'] === 'File gi&agrave; presente' && ! empty($_SESSION['pdf_to_deleteL'])) {
                ?>
                          <button onclick=location.href="upload/elimina_pdfSE.php">elimina</button>
                    <?php
            }
        }
        ?>
		
		
		
		</th>
	</tr>
	<tr style="height: 60px">
		<td><input type="submit" value="Inserisci Esercizio"></td>
	</tr>
</form>

<tr>
	<td align="center" id="indietro"><strong><a href="elenco-corsi.html">
				Indietro</a></strong></td>
</tr>
