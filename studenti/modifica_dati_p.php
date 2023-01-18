<?php
include 'config/mysql-config.php';
session_start();
if(!$conn || empty($_SESSION['user'])){
    header("Location: ../index.html");
}

        $email_utente = $_SESSION['user'];

        $sql = "SELECT * FROM utente WHERE email='$email_utente'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $utente = $result->fetch_assoc();
        } else {
            echo "0 results";
        }
        $id_u = $utente['id'];
        
        $result2 = $conn->query("SELECT * FROM studente WHERE utente_s = '$id_u'");
        $studente = $result2->fetch_assoc();
        ?>

        <form action="studenti/modificaDatiUtente.php" method="post">

            <table id="pannello_controllo" cellspacing="0" cellspadding="0" style="width: 100%" align="center"  >

                <tr style="height: 70px" id="titolo">
                    <th align="center"  style="color: #0e83cd;font-size: 26px">

                        Modifica Dati Profilo

                    </th>
                </tr>

                <tr align="center" style="height: 60px">
                    <td>
                        <label style="color: #0e83cd">Nome: </label>
                        <label id="firstName"> <?php echo $utente['nome']; ?></label>&nbsp;&nbsp;
                        
                    </td>
                </tr>
                <tr style="height: 60px">
                    <td style="padding-right: 10px" >
                        <label style="color: #0e83cd">Cognome: </label>
                        <label id="cognome"><?php echo $utente['cognome']; ?></label>&nbsp;&nbsp;
                        
                    </td>
                   
                </tr>

                <tr align="center" style="height: 60px">

                    <td><p>
                        <label style="color: #0e83cd">Email: </label><p>
                        <label> <input type="text" style="width: 300px"  id="email" name="email" value="<?php echo $utente['email']; ?>"></label>
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
					<input type="text" id="via" name="via" maxlength="255" size="30" value="<?php echo $studente['via']?>" >
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
						size="30" value="<?php echo $studente['n_civico']?>">
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
						size="30"  value="<?php echo $studente['citta']?>">
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
						size="30" value="<?php echo $studente['provincia']?>">
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
					<input type="text" id="cap" name="cap" maxlength="5" size="30" value="<?php echo $studente['cap']?>">
					<script type="text/javascript">
                                    var cap_ = new LiveValidation('cap', {onlyOnSubmit: true});
                                    cap_.add(Validate.Presence);
                                    cap_.add(Validate.InteriPositivi);
                                </script>
				</p>
			</td>
			</tr>
                <tr>
                    <td>
                        <input type="submit" value="Conferma Modifiche">
                    </td>
                </tr>
<tr>
		<td align="center" id="indietro" style="height: 60px"><strong><a href="modifica-dati.html">
					Indietro</a></strong></td>
	</tr>
            </table>
        </form>
    
