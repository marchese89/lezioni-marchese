<?php
session_start();
include 'config/mysql-config.php';
include 'script/funzioni-php.php';
?>
<script type="text/javascript">
function cliccaFile(){
    $('#fileuploadPDF_L').click();
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


function mandaPdfL(supportAjaxUpload, formID) {
    if (supportAjaxUpload) {
        document.getElementById("progressBar").style.display = 'block';
        
        var file_ = _("fileuploadPDF_L").files[0];
        
        var formdata_ = new FormData();
        formdata_.append("fileuploadPDF_L", file_);
        formdata_.append("UploadPDF_L", "__");
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


function carica_lezioni(id_corso) {
	  if (id_corso == "") {
	    document.getElementById("lezioni_corso").innerHTML = "";
	    return;
	  } else {
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	      if (this.readyState == 4 && this.status == 200) {
	        document.getElementById("lezioni_corso").innerHTML = this.responseText;
	      }
	    };
	    xmlhttp.open("GET","richieste_ajax/lezioni_corso.php?id="+id_corso,true);
	    xmlhttp.send();
	  }
	}
</script>
<tr style="height: 60px">
	<td><label style="font-size: 18px">Inserisci nuova Lezione</label></td>
</tr>
<form action="insegnanti/inserisci_lezione.php" method="post">
	<tr style="height: 60px;">

		<td><label>Area Tematica - Materia - Corso</label> <select
			name="corso" id="corso" onchange="carica_lezioni(this.value)">
				
	<?php
$email = $_SESSION['user'];
$id_insegnante = trova_id_insegnante($email);

$result0 = $conn->query("SELECT * FROM corso");
while ($row = $result0->fetch_assoc()) {
    $id_mat = $row['materia'];
    $result = $conn->query("SELECT * FROM materia WHERE id='$id_mat'");
    $r = $result->fetch_assoc();
    $id_a_t = $r['area_tematica'];
    $result2 = $conn->query("SELECT * FROM area_tematica WHERE id='$id_a_t'");
    $row2 = $result2->fetch_assoc();
    ?>
	    <option value="<?php echo $row['id'];?>"><?php echo  $row2['nome'] . " - ". $r['nome']. " - " . $row['nome'];?></option>
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
	<tr style="text-align: center">
		<th style="text-align: center; alignment-adjust: central">
           <?php
        if (! isset($_SESSION['percorsoPDF_L'])) {
            ?>
	
		
		
	
	
	
	<tr align="center">
	
	
	<tr align="center">
		<th style="height: 70px; width: 780px; text-align: center"
			align="ce
	
	nter">
			<form enctype="multipart/form-data" method="post"
				action="upload/upload.php" id="loadPdfL">
				<input id="fileuploadPDF_L" name="fileuploadPDF_L" type="file"
					accept=".pdf" class="file_upload" onchange="visualizza_pdfL(this)" />
				<input type="button" value="Scegli un file" id="btn2"
					onclick="cliccaFile()" /><span style="opacity: 0">_</span> <img
					id="ant_pdfL" width="30" height="30" style="opacity: 0" /><span
					style="opacity: 0; font-size: 11px; font-stretch: initial"
					id="nome_pdfTS">______</span> <input type="button" value="Upload"
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
				<button value="elimina" onclick=location.href="upload/elimina_pdfL.php">elimina</button>
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
                          <button onclick=location.href="upload/elimina_pdfL.php">elimina</button>
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
