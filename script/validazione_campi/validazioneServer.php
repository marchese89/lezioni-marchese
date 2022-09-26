<?php


function validaCF($cf){
    return preg_match("/^[a-z]{6}[0-9]{2}[a-z][0-9]{2}[a-z][0-9]{3}[a-z]{1}$/i", $cf);
}

function validaTel($tel){
    return preg_match("/^[0-9]{6,}$/i", $tel);
}

function validaPiva($piva){
    return preg_match("/^[0-9]{11}$/i", $piva);
}

function vocale($c){
   if(strlen($c) != 1){
        return FALSE;
    }
    switch ($c) {
        case 'a':return TRUE;
        case 'A':return TRUE;
        case 'e':return TRUE;
        case 'E':return TRUE;
        case 'i':return TRUE;
        case 'I':return TRUE;
        case 'o':return TRUE;
        case 'O':return TRUE;
        case 'u':return TRUE;
        case 'U':return TRUE;
        default:return FALSE;
    }
    
}

function consonante($c){
    if(strlen($c) != 1){
        return FALSE;
    }
    if(!preg_match("/^[a-zA-Z]$/i", $c)){
        return FALSE;
    }
    
    if(!vocale($c)){
        return TRUE;
    }else{
        return FALSE;
    }
    
}

function primaConsonante($stringa){
    for($i = 0; $i < strlen($stringa); $i++){
        if(consonante($stringa[$i])){
            return $stringa[$i];
        }
    }
    return $i;
}
function nomeCognCF($nome, $cognome, $cf){
    if( primaConsonante($cognome) == $cf[0]  && primaConsonante($nome) == $cf[3] ){
       return TRUE;
    }else{
       return FALSE;
    }
    
}

