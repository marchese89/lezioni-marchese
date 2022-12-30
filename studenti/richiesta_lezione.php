<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.html");
}


?>
<script type="text/javascript">
function cliccaFile(){
    $('#fileuploadPDF_RL').click();
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


function mandaPdfRL(supportAjaxUpload, formID) {
    if (supportAjaxUpload) {
        document.getElementById("progressBar").style.display = 'block';
        
        var file_ = _("fileuploadPDF_RL").files[0];
        
        var formdata_ = new FormData();
        formdata_.append("fileuploadPDF_RL", file_);
        formdata_.append("UploadPDF_RL", "__");
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



function visualizza_pdfRL(img){
    $('#ant_pdfRL').attr('src', img.value);
    
    var reader = new FileReader();
    reader.onload = function (e) {
       $('#ant_pdfRL').attr('src', 'images/miniatura_pdf.png');
    }
    reader.readAsDataURL(img.files[0]);
    document.getElementById("ant_pdfRL").style.opacity = "1";
    var file = img.files[0];  
    var filename = file.name;
    $('#nome_pdfRL').html('&nbsp;&nbsp;&nbsp;' +filename);
    document.getElementById("nome_pdfRL").style.opacity = "1";
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
	    xmlhttp.open("GET","richieste_ajax/carica_corsi_materia2.php?id="+id_materia,true);
	    xmlhttp.send();
	  }
	}


function aggiungi_corso(){
	var form = document.getElementById('form_lez_r');
  var input = document.createElement('input');
  input.setAttribute('name', 'corso');
  input.setAttribute('value', document.getElementById('select_corso').value);
  input.setAttribute('type', 'hidden');
  form.appendChild(input);
}
</script>
<?php 
if(studente($_SESSION['user'],$conn)){
?>

<table align="center" id="pannello_controllo" >
	
		<tr id="titolo">
			<th>Richiesta Svolgimento lezione su Commissione</th>
		</tr>
		<tr>
		<td>
		<label>Inserisci un file "traccia" per richiedere lo svolgimento di una lezione su commissione,</label>
		</td>
		</tr>
		<tr>
		<td>
		<label>lo svolgimento o la correzione di un esercizio</label>
		</td>
		</tr>
		<tr>
		<td>
		<label>L'insegnante interessato produrr&agrave; una risposta che sar&agrave; visibile sul tuo profilo studente</label>
		</td>
		</tr>
		<tr>
		<td>
		<label>A quel punto potrai vedere il prezzo e decidere se acquistarla</label>
		</td>
		</tr>
		<tr>
		<td>
		<label>Sono inclusi nel prezzo eventuali chiarimenti via chat (disponibili dopo l'acquisto)</label>
		</td>
		</tr>
		<tr style="text-align: center">
		<th style="text-align: center; alignment-adjust: central">
           <?php
        if (! isset($_SESSION['percorsoPDF_RL'])) {
            ?>	
	
	<tr align="center">
		<th style="height: 70px; width: 780px; text-align: center"
			align="center">
			<form enctype="multipart/form-data" method="post"
				action="upload/upload.php" id="loadPdfRL">
				<input id="fileuploadPDF_RL" name="fileuploadPDF_RL" type="file"
					accept=".pdf,image/*" class="file_upload" onchange="visualizza_pdfRL(this)" />
				<input type="button" value="Scegli un file" id="btn2"
					onclick="cliccaFile()" /><span style="opacity: 0">_</span> <img
					id="ant_pdfRL" width="30" height="30" style="opacity: 0" /><span
					style="opacity: 0; font-size: 11px; font-stretch: initial"
					id="nome_pdfRL">______</span> <input type="button" value="Upload"
					name="UploadPDFRL"
					onclick="mandaPdfRL(ajaxUploadSupport(),'loadPdfRL')" /><br>
				<progress id="progressBar" value="0" max="100"
					style="width: 300px; display: none; margin-left: auto; margin-right: auto"></progress>
				<br> <span id="status" style="font-size: 12px"></span><br> <span
					id="loaded_n_total" style="font-size: 12px"></span>
			</form>
               
                    <?php
        } else if ($_SESSION['pdfRLCaricato'] === "OK") {
            ?>
                    <p>
				<label><font color="green">File Richiesta Lezione caricato correttamente</font></label>
			
			<p>
				<button value="elimina" onclick=location.href="upload/elimina_pdfRL.php">elimina</button>
				<br>
				<br>
				<label>Area Tematica</label> <select name="area_tematica"
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
		
		</select>
		<br>
		
			<div id="materia"></div>
		<br>
			<div id="corso"></div>
			
			<br>
				<form  action="studenti/carica-richiesta-lezione.php" method="post" id="form_lez_r" onsubmit="aggiungi_corso()">
				<label>Titolo Lezione    </label><input type="text" id="titolo_l" name="titolo_l" maxlength="45"
						size="30">
					<script type="text/javascript">
                                    var titolo_l_ = new LiveValidation('titolo_l', {onlyOnSubmit: true});
                                    titolo_l_.add(Validate.Presence);
                                    titolo_l_.add(Validate.SoloTesto);
                                </script>
                                <br>
                                <br>
				<input type="submit" value="Invia Richiesta">
				       </form>
                        <?php
        } else {
            unset($_SESSION['pdfRLCaricato']);
            $motivoErrore = $_SESSION['motivo_errore_pdfRL'];
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
            if ($_SESSION['motivo_errore_pdfRL'] === 'File gi&agrave; presente' && ! empty($_SESSION['pdf_to_deleteRL'])) {
                ?>
                          <button onclick=location.href="upload/elimina_pdfRL.php">elimina</button>
                    <?php
            }
        }
        ?>
		
		
		
		
		</th>
	</tr>
</table>

<?php 
}else{
    ?>
    <table align="center" width="100%" id="pannello_controllo" cellspacing=0 cellpadding=0>
    
    <tr id="titolo">
    <th>Richiesta Svolgimento lezione su Commissione</th>
    </tr>
    <tr style="height: 60px">
    <td><font color="red" style="font-size: 18px">Devi fare il login come studente per accedere a questa funzionalità</font></td>
    </tr>
    <?php 
}
?>