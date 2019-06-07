<?php

/*Classe que instancia objetos para uso dos estoque */
class EstoqueDTO {
    //Atributos privados da classe
    private $idestoque;
    private $nome;
    private $capacidade;
    /*----------------------------*/
    //Metodos de get dos atributos privados da classe
    function getIdestoque() {
        return $this->idestoque;
    }

    function getNome() {
        return $this->nome;
    }

    function getCapacidade() {
        return $this->capacidade;
    }
    /*----------------------------------------*/
    //Metodos de set dos atributos privados da classe
    function setIdestoque($idestoque) {
        $this->idestoque = $idestoque;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCapacidade($capacidade) {
        $this->capacidade = $capacidade;
    }


}
