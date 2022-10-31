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

        <form action="toLoad/modificaDatiUtente.php" method="post">

            <table id="prev" cellspacing="0" cellspadding="0" width="1030" align="center" style="height: 646px" >

                <tr style="height: 120px">
                    <td align="center" colspan="4" style="color: #0e83cd;font-size: 26px">

                        Modifica Dati Profilo

                    </td>
                </tr>

                <tr align="center" style="height: 80px">
                    <td>
                        <label style="color: #0e83cd">Nome: </label>
                        <label id="firstName"> <?php echo $argomento['nome']; ?></label>&nbsp;&nbsp;
                        
                    </td>
                </tr>
                <tr>
                    <td style="padding-right: 10px" >
                        <label style="color: #0e83cd">Cognome: </label>
                        <label id="cognome"><?php echo $argomento['cognome']; ?></label>&nbsp;&nbsp;
                        
                    </td>
                   
                </tr>

                <tr align="center" style="height: 80px">

                    <th>
                        <label style="color: #0e83cd">Email: </label>
                        <label> <input type="text" style="width: 300px"  id="email" name="emailC" value="<?php echo $argomento['email']; ?>"></label>
                        <script type="text/javascript">
                            var email1 = new LiveValidation('email');
                            email1.add(Validate.Presence);
                            email1.add(Validate.Email);
                        </script>
                    </th>
                  
                </tr>

                <tr align="center" height="120" valign="center">
                    <th colspan="4" >
                        <input type="submit" value="Conferma Modifiche">
                    </th>
                </tr>
                <tr valign="bottom" >
                    <th colspan="4" style="padding-bottom: 20px">
                        <a href="modifica-dati.html" class="collegamento">Indietro</a>
                    </th>
                </tr>
            </table>
        </form>
    
