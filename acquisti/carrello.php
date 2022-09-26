<?php

class ElementoC {

private $idProdotto;
//contiene l'id finale delle prop 
//che identificano prodotto, caratteristica e valore)
private $prop;
private $qta;
private $prezzo;
private $prezzoIvato;
private $percorsoFile;
private $tipoElemento = 0; // 0 = prodotto stampa, 1 = prodotto generico

public function __construct($prodotto) {
$this->idProdotto = $prodotto;
$this->prop = array();
}

public function getId() {
return $this->idProdotto;
}

public function setQta($qta) {
$this->qta = $qta;
}

public function setTipoElemento($tipo){
    $this->tipoElemento = $tipo;
}

public function getTipoElemento(){
    return $this->tipoElemento; 
}
public function addProp($idProp) {
array_push($this->prop, $idProp);
}

public function removeProp($id) {
$index = $this->trovaProp($id);
if ($index >= 0) {
unset($this->prop[$index]);
array_merge($this->prop);
}
}

public function setPrezzo($p) {
$this->prezzo = $p;
}

public function getPrezzo() {
return $this->prezzo;
}

public function setPrezzoIvato($p) {
$this->prezzoIvato = $p;
}

public function getPrezzoIvato() {
return $this->prezzoIvato;
}

private function trovaProp($idP) {
for ($i = 0;
$i < count($this->prop);
$i++) {
if ($this->prop[$i] == $idP) {
return $i;
}
}
return -1;
}

public function getQta() {
return $this->qta;
}

public function getProprieta() {
return $this->prop;
}

public function getPercorsoFile() {
return $this->percorsoFile;
}

public function setPercorsoFile($percorsoFile) {
$this->percorsoFile = $percorsoFile;
}

public function eliminaFile() {
    error_reporting(E_ERROR | E_PARSE);
try{
    unlink("../" . $this->percorsoFile);
    unlink($this->percorsoFile);
}catch (Exception $e){
    header("Location: ../index.php");
}
error_reporting(ALL);
}

}

class Carrello {

private $elementi;
private $modPagamento;
private $costoSpedizione;
private $costiAggiuntivi;

public function __construct() {
$this->elementi = array();
$this->costoSpedizione = 0;
$this->modPagamento = '';
$this->costiAggiuntivi = 0;
}

public function aggiungi(ElementoC $elem) {
array_push($this->elementi, $elem);
return TRUE;
}

public function rimuovi($id) {

$index = $this->trovaElemento($id);

if ($index !== -1) {
$this->elementi[$index]->eliminaFile();
unset($this->elementi[$index]);
$this->elementi = array_merge($this->elementi);
}
}

private function trovaElemento($id) {
$index = -1;
for ($i = 0;
$i < count($this->elementi);
$i++) {
$elemento = $this->elementi[$i];
if ($elemento->getId() == $id) {
$index = $i;
break;
}
}
return $index;
}

public function contenuto() {
return $this->elementi;
}

public function getTotale() {
$tot = 0;
foreach ($this->elementi as $p) {
$tot += $p->getPrezzo();
}
return $tot;
}

public function getTotaleIvato() {
$tot = 0;
foreach ($this->elementi as $p) {
$tot += $p->getPrezzoIvato();
}
return $tot;
}

public function getTotaleOrdine() {
$totP = $this->getTotale();
$temp = $totP + $this->costiAggiuntivi + $this->costoSpedizione;
return $temp;
}

public function getTotaleOrdineIvato() {
$totP = $this->getTotaleIvato();
$temp = $totP + $this->costiAggiuntivi + $this->costoSpedizione;
return $temp;
}

function vuotaCarrello() {
for ($index = 0;
$index < count($this->elementi);
$index++) {
$this->elementi[$index]->eliminaFile();
}
$this->elementi = array();
$this->costiAggiuntivi = 0;
$this->modPagamento = 'bonifico';
}

function getModPagamento() {
return $this->modPagamento;
}

function setModPagamento($mod) {
$this->modPagamento = $mod;
}

function setCostoSpedizione($costo) {
$this->costoSpedizione = $costo;
}

function getCostoSpedizione() {
return $this->costoSpedizione;
}

function getCostiAggiuntivi() {
return $this->costiAggiuntivi;
}

function setCostiAggiuntivi($costi) {
$this->costiAggiuntivi = $costi;
}

}
