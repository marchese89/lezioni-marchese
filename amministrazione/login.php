<?php
 if(!empty($_SESSION['user'])){
     header("Location: index.html");
 }
?>
<table id="prev"  width=100%>
    <tr align="center" valign="top">
        <th>
        <form action="amministrazione/risultato_login.php" method="post" >
            <table align="center" cellspacing="3" cellspadding="3" style="border-collapse: collapse"> 
                
                <tr align="center">
                    <td style="height: 80px;color: #0e83cd;font-size: 24px" >
                        Accesso
                    </td>
                </tr>

                <tr> 
                    <td align="center" height="40">
                        Email
                    </td>
                </tr>
                <tr>
                    <td align="center" height="40">
                        <input type="text" name = "email" maxlength="45" size="24" autofocus="true">
                    </td>
                </tr>
                <tr>
                    <td align="center" height="40">
                        Password
                    </td>
                </tr>
                <tr>
                    <td align="center" height="40">
                        <input type ="password" name = "password" maxlength="45" size="24">
                    <td>
                </tr>

                <tr>
                    <td align="center" height="40">
                        <input type="submit"  value="Login" >
                    </td>
                <br>
                </tr>
                
            </table>
        </form>
   
</th>
</tr>
<tr valign="bottom"> 
                    <td align="center" height="40">
                        <a href="index.php?pagina=amministrazione/recupero_credenziali.php" class="collegamento" >recupera password</a>
                        <br>
                    </td>
                </tr>
                <tr valign="bottom">
                    <td align="center" height="40">
                        <a href="registrati.html" class="collegamento">registrati</a>
                    </td>
                </tr>
                <tr valign="bottom">
                    <?php
                    if (!empty($_SESSION['loginCorretto']) && $_SESSION['loginCorretto'] === FALSE) {
                        ?>
                        <td><font color="red" size="4.5">Email o password non validi.</font></td>
                        <?php
                    } else {
                        ?>
                        <td>&nbsp;</td>
                    <?php } ?>
                </tr>
</table>