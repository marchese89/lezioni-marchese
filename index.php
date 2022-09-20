<?php
include 'config/mysql-config.php';
echo "ciao a tutti, questo sito mi serve per lavorare!";

$res0 = $conn->query("SELECT * FROM prova");
echo "elementi contenuti nella tabella di prova    ";
while ($elem = $res0->fetch_assoc()) {
    echo $elem['idprova'];
    echo $elem['provacol'];
}
?>