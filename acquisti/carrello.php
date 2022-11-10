<?php

class ElementoC
{
    
    private $idProdotto;

    private $prezzo;

    //tipi: 0=lezione, 1=tutte le lezioni di un corso, 2=esercizio, 3=tutti gli esercizi di un corso
    //4= tutte le lezioni e tutti gli esercizi di un corso
    private $tipoElemento = 0;

    private $nome;
   
    public function __construct($id,$tipo_elem)
    {
        $conn = mysqli_connect("localhost", "root", "[]x?,U*<VkcbFRF,WM]T", "easy-learning");
        $this->idProdotto = $id;
        $this->tipoElemento = $tipo_elem;
        switch ($this->tipoElemento){
            case 0://lezione
                $result1 = $conn->query("SELECT * FROM lezione WHERE id='$this->idProdotto'");
                $lez = $result1->fetch_assoc();
                $this->nome = $lez['titolo'];
                $this->prezzo = $lez['prezzo'];
                break;
            case 1://tutte le lezioni di un corso
                $prez = 0;
                $result1 = $conn->query("SELECT * FROM argomento WHERE corso_arg='$this->idProdotto'");
                while($arg = $result1->fetch_assoc()){
                    $id_arg = $arg['id'];
                    $result2 = $conn->query("SELECT * FROM lezione WHERE arg_lez='$id_arg'");
                    while($lex = $result2->fetch_assoc()){
                        $prez = $prez+$lex['prezzo'];
                    }
                }
                $this->prezzo = $prez;
                $result3 = $conn->query("SELECT * FROM corso WHERE id='$this->idProdotto'");
                $corso = $result3->fetch_assoc();
                $this->nome = "Tutte le lezioni: " . $corso['nome'];
                break;
            case 2://esercizio
                $result1 = $conn->query("SELECT * FROM esercizio WHERE id='$this->idProdotto'");
                $ex = $result1->fetch_assoc();
                $this->nome = $ex['titolo'];
                $this->prezzo = $ex['prezzo'];
                break;
            case 3://tutti gli esercizi di un corso
                $prez = 0;
                $result1 = $conn->query("SELECT * FROM argomento WHERE corso_arg='$this->idProdotto'");
                while($arg = $result1->fetch_assoc()){
                    $id_arg = $arg['id'];
                    $result2 = $conn->query("SELECT * FROM esercizio WHERE argomento='$id_arg'");
                    while($ex = $result2->fetch_assoc()){
                        $prez = $prez+$ex['prezzo'];
                    }
                }
                $this->prezzo = $prez;
                $result3 = $conn->query("SELECT * FROM corso WHERE id='$this->idProdotto'");
                $corso = $result3->fetch_assoc();
                $this->nome = "Tutti gli esercizi: " . $corso['nome'];
                break;
            case 4://tutte le lezioni e tutti gli esercizi di un corso
                $prez = 0;
                $result1 = $conn->query("SELECT * FROM argomento WHERE corso_arg='$this->idProdotto'");
                while($arg = $result1->fetch_assoc()){
                    $id_arg = $arg['id'];
                    $result2 = $conn->query("SELECT * FROM lezione WHERE arg_lez='$id_arg'");
                    while($lex = $result2->fetch_assoc()){
                        $prez = $prez+$lex['prezzo'];
                    }
                    $result3 = $conn->query("SELECT * FROM esercizio WHERE argomento='$id_arg'");
                    while($ex = $result3->fetch_assoc()){
                        $prez = $prez+$ex['prezzo'];
                    }
                }
                $this->prezzo = $prez;
                $result4 = $conn->query("SELECT * FROM corso WHERE id='$this->idProdotto'");
                $corso = $result4->fetch_assoc();
                $this->nome = "Corso Completo: " .$corso['nome'];
                break;
            default:
                break;
        }
    }

    public function getId()
    {
        return $this->idProdotto;
    }

    public function getTipoElemento()
    {
        return $this->tipoElemento;
    }

    public function getPrezzo()
    {
        return $this->prezzo;
    }
    
    public function getNome()
    {
        return $this->nome;
    }

}

class Carrello
{

    private $elementi;

    public function __construct()
    {
        $this->elementi = array();
    }

    public function aggiungi(ElementoC $elem)
    {
        $conn = mysqli_connect("localhost", "root", "[]x?,U*<VkcbFRF,WM]T", "easy-learning");
        
        $id = $elem->getId();
        $tipo = $elem->getTipoElemento();
        //verifichiamo se l'elemento è già presente
        $ind = $this->trovaElemento($id, $tipo);
        if($ind !== -1){
            return TRUE;
        }
        //verifichiamo se è già presente un insieme che include già l'elemento (niente da inserire)
        //il tipo è una lezione
        if($tipo === 0){
            $result1 = $conn->query("SELECT * FROM lezione WHERE id='$id'");
            $lez = $result1->fetch_assoc();
            $id_arg = $lez['arg_lez'];
            $result2 = $conn->query("SELECT * FROM argomento WHERE id='$id_arg'");
            $arg = $result2->fetch_assoc();
            $id_corso = $arg['corso_arg'];
            $ind = $this->trovaElemento($id_corso, 1);//tutte le lezioni
            if($ind !== -1){
                return TRUE;
            }
            $ind = $this->trovaElemento($id_corso, 4);//tutte le lezioni e tutti gli esercizi
            if($ind !== -1){
                return TRUE;
            }
        }
        
        //il tipo è un esercizio
        if($tipo === 2){
            $result1 = $conn->query("SELECT * FROM esercizio WHERE id='$id'");
            $lez = $result1->fetch_assoc();
            $id_arg = $lez['argomento'];
            $result2 = $conn->query("SELECT * FROM argomento WHERE id='$id_arg'");
            $arg = $result2->fetch_assoc();
            $id_corso = $arg['corso_arg'];
            $ind = $this->trovaElemento($id_corso, 3);//tutti gli esercizi
            if($ind !== -1){
                return TRUE;
            }
            $ind = $this->trovaElemento($id_corso, 4);//tutte le lezioni e tutti gli esercizi
            if($ind !== -1){
                return TRUE;
            }
        }
        
        //verifichiamo se è già presente una lezione o un esercizio e stiamo aggiungendo l'insieme grande
        //(eliminazione di tutti gli elementi già inseriti che fanno parte dell'insieme che stiamo inserendo)
        //stiamo aggiungendo tutte le lezioni di un corso (eliminiamo tutte le lezioni singole già eventualmente
        //inserite
        if($tipo === 1){//tutte le lezioni
            $result1 = $conn->query("SELECT * FROM argomento WHERE corso_arg='$id'");
            while($arg = $result1->fetch_assoc()){
                $id_arg = $arg['id'];
                $result2 = $conn->query("SELECT * FROM lezione WHERE arg_lez='$id_arg'");
                while($lez = $result2->fetch_assoc()){
                    $id_lez = $lez['id'];
                    $ind = $this->trovaElemento($id_lez, 0);
                    if($ind !== -1){//la lezione esiste già e va cancellata
                       $this->rimuovi($id_lez, 0); 
                    }
                }
            }
            $ind = $this->trovaElemento($id, 4);//tutte le lezioni e tutti gli esercizi
            if($ind !== -1){
                return TRUE;
            }
        }
        
        if($tipo === 3){//inseriamo tutti gli esercizi di un corso (eliminiamo quelli singoli)
            $result1 = $conn->query("SELECT * FROM argomento WHERE corso_arg='$id'");
            while($arg = $result1->fetch_assoc()){
                $id_arg = $arg['id'];
                $result2 = $conn->query("SELECT * FROM esercizio WHERE argomento='$id_arg'");
                while($ex = $result2->fetch_assoc()){
                    $id_ex = $ex['id'];
                    $ind = $this->trovaElemento($id_ex, 2);
                    if($ind !== -1){//la lezione esiste già e va cancellata
                        $this->rimuovi($id_ex, 2);
                    }
                }
            }
            $ind = $this->trovaElemento($id, 4);//tutte le lezioni e tutti gli esercizi
            if($ind !== -1){
                return TRUE;
            }
        }
        
        if($tipo === 4){//inseriamo tutte le lezioni e tutti gli esercizi di un corso (eliminiamo tutti i singoli)
            $result1 = $conn->query("SELECT * FROM argomento WHERE corso_arg='$id'");
            while($arg = $result1->fetch_assoc()){
                $id_arg = $arg['id'];
                $result2 = $conn->query("SELECT * FROM lezione WHERE arg_lez='$id_arg'");
                while($lez = $result2->fetch_assoc()){
                    $id_lez = $lez['id'];
                    $ind = $this->trovaElemento($id_lez, 0);
                    if($ind !== -1){//la lezione esiste già e va cancellata
                        $this->rimuovi($id_lez, 0);
                    }
                }
                $result3 = $conn->query("SELECT * FROM esercizio WHERE argomento='$id_arg'");
                while($ex = $result3->fetch_assoc()){
                    $id_ex = $ex['id'];
                    $ind = $this->trovaElemento($id_ex, 2);
                    if($ind !== -1){//la lezione esiste già e va cancellata
                        $this->rimuovi($id_ex, 2);
                    }
                }
            }
            //cerchiamo gli insiemi (tutte le lezioni/tutti gli esercizi)
            if($this->trovaElemento($id, 1) !== -1){
                $this->rimuovi($id, 1);
            }    
                
            if($this->trovaElemento($id, 3)!== -1){
                $this->rimuovi($id, 3);
            }
        }
        
        array_push($this->elementi, $elem);
        return TRUE;
    }

    public function rimuovi($id,$tipo)
    {
        $index = $this->trovaElemento($id,$tipo);
        if ($index !== - 1) {
            unset($this->elementi[$index]);
            $this->elementi = array_merge($this->elementi);
            return TRUE;
        }
        return FALSE;
    }

    private function trovaElemento($id,$tipo)
    {
        $index = - 1;
        for ($i = 0; $i < count($this->elementi); $i ++) {
            $elemento = $this->elementi[$i];
            if ($elemento->getId() == $id && $elemento->getTipoElemento() == $tipo) {
                $index = $i;
                break;
            }
        }
        return $index;
    }

    public function contenuto()
    {
        return $this->elementi;
    }
    
    public function nElementi(){
        return count($this->elementi);
    }

    public function getTotale()
    {
        $tot = 0;
        foreach ($this->elementi as $p) {
            $tot += $p->getPrezzo();
        }
        return $tot;
    }



    function vuotaCarrello()
    {
        for ($index = 0; $index < count($this->elementi); $index ++) {
            $this->elementi[$index]->eliminaFile();
        }
        $this->elementi = array();
    }
}
