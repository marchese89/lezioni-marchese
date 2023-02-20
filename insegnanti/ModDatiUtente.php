<?php

if(!$conn){
    header("Location: ../index.html");
}
session_start();


$result =  $conn->query("SELECT * FROM amministratore");
$amministratore = $result->fetch_assoc();

?>


<table id="pannello_controllo" cellspacing="0" cellspadding="0" width="100%" align="center" >
    <tr style="height: 70px" id="titolo">
        <th align="center" colspan="2" style="color: #0e83cd;font-size: 26px">
            Modifica Dati Profilo
        </th>
    </tr>
    <tr>
		<td><label>Foto</label></td>
	</tr>
	<tr>
		<td><p><img src="<?php echo $amministratore['foto'];?>" height="250"
			width="250"></td>
	</tr>
	<tr>
		<td><button class="button" onclick=location.href="modifica_foto_ins.html">Modifica Foto</button></td>
	</tr>
	<?php 
	$res0 = $conn->query("SELECT * FROM certificati ORDER BY numero ASC");
	while($cert = $res0->fetch_assoc()){
	    ?>
	    <tr>
	    <td><label><?php echo $cert['nome'];?></label></td>
	    </tr>
	    <tr>
	    <td>
	    <iframe src="<?php echo $cert['percorso'];?>#view=FitH" width="90%" height="800px"></iframe>
		</td>
		</tr>
		<tr>
		<td>
		<button class="button" onclick=location.href="insegnanti/elimina_certificato.php?n=<?php echo $cert['numero']?>">Elimina <?php echo $cert['nome']?></button>
		</td>
		</tr>
	    <?php
	}
	?>

 <form action="insegnanti/modificaDatiUtente.php" method="post">

                <tr align="center" style="height: 60px">
                    <td>
                        <label style="color: #0e83cd">Nome: </label>
                        <label id="firstName"> <?php echo $amministratore['nome']; ?></label>&nbsp;&nbsp;
                        
                    </td>
                </tr>
                <tr style="height: 60px">
                    <td style="padding-right: 10px" >
                        <label style="color: #0e83cd">Cognome: </label>
                        <label id="cognome"><?php echo $amministratore['cognome']; ?></label>&nbsp;&nbsp;
                        
                    </td>
                   
                </tr>

                <tr align="center" style="height: 60px">

                    <td><p>
                        <label style="color: #0e83cd">Email: </label><p>
                        <label> <input type="text" style="width: 300px"  id="email" name="email" value="<?php echo $amministratore['email']; ?>"></label>
                        <script type="text/javascript">
                            var email1 = new LiveValidation('email', {onlyOnSubmit: true});
                            email1.add(Validate.Presence);
                            email1.add(Validate.Email);
                        </script>
                    </td>
                  
                </tr>
<tr>
			<td width="98">
				<p style="color: #0e83cd">Indirizzo (via/piazza)</p>
				<p>
					<input type="text" id="via" name="via" maxlength="255" size="30" value="<?php echo $amministratore['via']?>" >
					<script type="text/javascript">
                                    var via_ = new LiveValidation('via', {onlyOnSubmit: true});
                                    via_.add(Validate.Presence);
                                    via_.add(Validate.SoloTesto);
                                </script>
				</p>
			</td>
			</tr>
			<tr>
			<td width="98">
				<p style="color: #0e83cd">N.Civico</p>
				<p>
					<input type="text" id="n_civico" name="n_civico" maxlength="6"
						size="30" value="<?php echo $amministratore['n_civico']?>">
					<script type="text/javascript">
                                    var n_civico_ = new LiveValidation('n_civico', {onlyOnSubmit: true});
                                    n_civico_.add(Validate.Presence);
                                </script>
				</p>
			</td>
		</tr>
		<tr>
			<td width="98">
				<p style="color: #0e83cd">Citt&agrave;</p>
				<p>
					<input type="text" id="citta" name="citta" maxlength="255"
						size="30"  value="<?php echo $amministratore['citta']?>">
					<script type="text/javascript">
                                    var citta_ = new LiveValidation('citta', {onlyOnSubmit: true});
                                    citta_.add(Validate.Presence);
                                    citta_.add(Validate.SoloTesto);
                                </script>
				</p>
			</td>
			</tr>
			<tr>
			<td width="98">
				<p style="color: #0e83cd">Provincia</p>
				<p>
					<input type="text" id="provincia" name="provincia" maxlength="2"
						size="30" value="<?php echo $amministratore['provincia']?>">
					<script type="text/javascript">
                                    var provincia_ = new LiveValidation('provincia', {onlyOnSubmit: true});
                                    provincia_.add(Validate.Presence);
                                    provincia_.add(Validate.SoloTesto);
                                </script>
				</p>
			</td>
		</tr>
		<tr>
			<td width="98">
				<p style="color: #0e83cd">CAP</p>
				<p>
					<input type="text" id="cap" name="cap" maxlength="5" size="30" value="<?php echo $amministratore['cap']?>">
					<script type="text/javascript">
                                    var cap_ = new LiveValidation('cap', {onlyOnSubmit: true});
                                    cap_.add(Validate.Presence);
                                    cap_.add(Validate.InteriPositivi);
                                </script>
				</p>
			</td>
			</tr>
					<tr>
			<td width="98">
				<p style="color: #0e83cd">PIVA</p>
				<p>
					<input type="text" id="piva" name="piva" maxlength="11" size="30" value="<?php echo $amministratore['piva']?>">
					<script type="text/javascript">
                                    var piva_ = new LiveValidation('piva', {onlyOnSubmit: true});
                                    piva_.add(Validate.Presence);
                                    piva_.add(Validate.InteriPositivi);
                                </script>
				</p>
			</td>
			</tr>
			<td width="98">
				<p style="color: #0e83cd">Chiave Privata Stripe</p>
				<p>
					<input type="text" id="str_sk" name="str_sk" maxlength="107" size="110" value="<?php echo $amministratore['stripe_private_key']?>">
					<script type="text/javascript">
                                    var str_sk_ = new LiveValidation('str_sk', {onlyOnSubmit: true});
                                    str_sk_.add(Validate.Presence);
                                </script>
				</p>
			</td>
			</tr>
                <tr>
                    <td>
                        <input type="submit" value="Conferma Modifiche">
                    </td>
                </tr>
           </form>
    <tr>
    <td>
    <button onclick=location.href="nuovo-certificato.html" >Nuovo Certificato</button>
    </td>
    </tr>
	<tr>
	<td align="center" id="indietro" style="height: 60px"><strong><a
					href="home-insegnante.html">
					Indietro</a></strong></td>
		</tr>

</table>

