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
            $argomento = $result->fetch_assoc();
        } else {
            echo "0 results";
        }
        
        ?>

        
<form action="insegnanti/modificaDatiUtente.php" method="post">
            <table id="pannello_controllo" cellspacing="0" cellspadding="0"  align="center" style="width: 100%" >

                <tr style="height: 70px" id="titolo">
                    <th align="center" colspan="4" style="color: #0e83cd;font-size: 26px">

                        Modifica Dati Profilo

                    </th>
                </tr>

                <tr align="center" style="height: 60px">
                    <td>
                        <label style="color: #0e83cd">Nome: </label>
                        <?php echo $argomento['nome']; ?>
                        
                    </td>
                </tr>
                <tr style="height: 60px">
                    <td style="padding-right: 10px" >
                        <label style="color: #0e83cd">Cognome: </label>
                        <?php echo $argomento['cognome']; ?>
                        
                    </td>
                   
                </tr>

                <tr align="center" style="height: 60px">

                    <th>
                    
                        <label style="color: #0e83cd">Email: </label>
                        <label> <input type="text" style="width: 300px"  id="email" name="email" value="<?php echo $argomento['email']; ?>"></label>
                        <script type="text/javascript">
                            var email1 = new LiveValidation('email');
                            email1.add(Validate.Presence);
                            email1.add(Validate.Email);
                        </script>
                       
                    </th>
                  
                </tr>

                <tr align="center" style="height: 60px" valign="center">
                    <th colspan="4" >
                        <input type="submit" value="Conferma Modifiche">
                    </th>
                </tr>
                
			<td align="center" id="indietro"><strong><a
					href="modifica-dati-insegnante.html">
					Indietro</a></strong></td>
		</tr>
            </table>
        
     </form>
