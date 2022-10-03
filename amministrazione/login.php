<?php
 if(!empty($_SESSION['user'])){
     header("Location: index.html");
 }
?>
<table id="prev"  width=100%>
    <tr align="center" valign="top">
        <th>
        <form action="amministrazione/risultato_login.php" method="post" >
            <table align="center"  width=100% style="border-collapse: collapse"> 
                
                <tr align="center" >
                    <td style="height: 80px;color: #0e83cd;font-size: 24px;" >
                        Accesso
                    </td>
                </tr>

                <tr> 
                    <td align="center" height="40" style="color: #0e83cd;">
                        Email
                    </td>
                </tr>
                <tr>
                    <td align="center" height="40">
                        <input type="text" name = "email" id="email" maxlength="45" size="24" autofocus="true">
                        <script type="text/javascript">
                                    var email1 = new LiveValidation('email', {onlyOnSubmit: true});
                                    email1.add(Validate.Presence);
                                    email1.add(Validate.Email);
                                </script>
                    </td>
                </tr>
                <tr>
                    <td align="center" height="40" style="color: #0e83cd;">
                        Password
                    </td>
                </tr>
                <tr>
                    <td align="center" height="40">
                        <input type ="password" name = "password" id="pass" maxlength="45" size="24">
                        <script type="text/javascript">
                                    var pass1_ = new LiveValidation('pass', {onlyOnSubmit: true});
                                    pass1_.add(Validate.Presence);
                                </script>
                    <td>
                </tr>

                <tr>
                    <td align="center" height="50">
                        <input type="submit"  value="Login">
                    </td>
                <br>
                </tr>
                
            </table>
        </form>
   
</th>
</tr>
<tr valign="bottom"> 
                    <td align="center" height="40">
                        <a href="recupero_credenziali.html" class="collegamento" >recupera password</a>
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