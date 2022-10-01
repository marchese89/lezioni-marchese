
<table width="1030px" border="0" style="margin-left: auto;margin-right: auto" cellspacing="0" id="prev">
    <tr><th colspan="2"  height="90px"><h2>Accesso</h2></th></tr>
    <tr>
        <th style="text-align: center">
            Sei gi&agrave; nostro cliente 
<form action="amministrazione/risultato_login.php?return=2" method="post">
            <table align="center" cellspacing="3" cellspadding="3" style="border-collapse: collapse" > 

                <tr> 
                    <td align="center">
                        Email
                        <br>
                </tr>
                <tr>
                    <td align="center">
                        <input type="text" name = "email" maxlength="45" size="14">
                        <br>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        Password
                        <br>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <input type ="password" name = "password" maxlength="45" size="14">
                        <br>
                    <td>
                </tr>

                <tr>
                    <td align="center">
                        <input type="submit"  value="Login" >
                        <br>
                    </td>
                <br>
                </tr>
                <tr> 
                    <td align="center">
                        <a href="" ><font size=4>Password dimenticata?</font></a>
                        <br>
                    </td>
                </tr>
                
                <tr>
                    <?php
                    if ($_SESSION['loginCorretto'] === FALSE) {
                        ?>
                        <td><font color="red" size="4.5">Email o password non validi.</font></td>
                        <?php
                    } else {
                        ?>
                        <td>&nbsp;</td>
                    <?php } ?>
                </tr>
            </table>
        </form>
</th>
<th>
    Non sei ancora nostro cliente
    <br>
    <a href="index.php?pagina=amministrazione/registrazione.php&return=2"><b>Registrati</b></a>
                    
</th>
</tr>

</table>