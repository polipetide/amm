<?php
    /* 
        Classe che definisce un prodotto nelle sue caratteristiche
    */
     
    class Prodotto {
        private $id;             // codice identificativo del prodotto
        private $nome;           // name
        private $colore;         // color
        private $famiglia;       // description
        private $tipo;           // (Fiore, Pianta, Bouquet, FF)
        private $prezzo;         // prezzo del prodotto
        private $num;            // numero di tale prodotto
        private $foto;           // foto del prodotto
        private $descrizione;    // descrizione del prodotto
         
        public function __construct($id, $nome, $colore, $famiglia, $tipo, $prezzo, $num, $foto, $descrizione) {
            $this->id = $id;
            $this->nome = $nome;
            $this->colore= $colore;
            $this->famiglia = $famiglia;
            $this->tipo = $tipo;
            $this->prezzo = $prezzo;
            $this->num = $num;
            $this->foto = $foto;
            $this->descrizione = $descrizione;
        }
 
        public function getType(){
        if( $this->tipo == "fiori")
            return "fiori";
        if( $this->tipo == "piante")
            return "piante";
        if( $this->tipo == "bouquet")
            return "bouquet";
        if( $this->tipo == "ff")
            return "ff";
        }      
 
        public function getId(){
            return $this->id;
        }
        public function getNome(){
            return $this->nome;
        }
        public function getcolore(){
            return $this->colore;
        }
        public function getFamiglia(){
            return $this->famiglia;
        }
        public function getTipo(){
            return $this->tipo;
        }
        public function getPrezzo(){
            return $this->prezzo;
        }
        public function getNum(){
            return $this->num;
        }
        public function getPhoto(){
            return $this->foto;
        }
 
        public function getDescrizione(){
            return $this->descrizione;
        }
 
 
    }
?>