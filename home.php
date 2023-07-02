<?php
if (!$conn) {
  header("Location: ../index.html");
}

$result =  $conn->query("SELECT * FROM amministratore");
$amministratore = $result->fetch_assoc();

?>
<style>
  p {
    font-size: 2.0em;
  }
</style>
<div class="container" style="text-align: center">
  <br>
  <br>
  <img alt="Foto" src="<?php echo $amministratore['foto']; ?>" height="400" style="border-radius: 10px 10px 10px 10px" />
  <p>Laureato Magistrale in Ingegeria Informatica (110/110)</p>
  <p>Offre supporto allo studio:</p>
  <p>soluzione esercizi</p>
  <p>lezioni private online</p>
  <p>Tariffe:</p>
  <p><strong style="color: green">Gratis</strong> fino al 31 luglio 2023</p>
  <p><strong>14&euro;</strong> l'ora per le scuole superiori</p>
  <p><strong>18&euro;</strong> l'ora per l'univesit&agrave;</p>
  <p>Prima lezione <strong style="color: green">Gratis</strong></p>
  <p><strong>Contatti:</strong></p>
  <p>Email:<a href="mailto:marchese89@hotmail.com" style="font-size: 20pt;">marchese89@hotmail.com</a></p>
  <p>Telefono:<a href="tel:+393272991334" style="font-size: 20pt;">+393272991334</a></p>
  <p>
    <img src="https://cdn-icons-png.flaticon.com/512/124/124034.png?w=360" width="30px" style="border-radius: 5px 5px 5px 5px;">
    <a href="https://api.whatsapp.com/send?phone=3272991334" style="font-size: 20pt;" target="_blank">Invia messaggio su WhatsApp</a>
  </p>


</div>