<?php

/*Classe que instancia objetos para uso da relação entre estoque e produto */
class EstoqueProdutoDTO {
    //Atributos privados da classe
    private $produto;
    private $estoque;
    private $quantidade;
    /*----------------------------*/
    //Metodos de get dos atributos privados da classe
    function getProduto() {
        return $this->produto;
    }

    function getEstoque() {
        return $this->estoque;
    }

    function getQuantidade() {
        return $this->quantidade;
    }
    /*----------------------------------------*/
    //Metodos de set dos atributos privados da classe
    function setProduto($produto) {
        $this->produto = $produto;
    }

    function setEstoque($estoque) {
        $this->estoque = $estoque;
    }

    function setCapacidade($quantidade) {
        $this->quantidade = $quantidade;
    }


}
