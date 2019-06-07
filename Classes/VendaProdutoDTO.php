<?php

/* Classe reservada para atributos da relação de venda e produtos */
class VendaProdutoDTO {
    //Atributos privados da classe
    private $venda;
    private $produto;
    private $quantidade;
    
    /*----------------------------*/
    //Metodos de get dos atributos privados da classe
    function getVenda() {
        return $this->venda;
    }

    function getProduto() {
        return $this->produto;
    }

    function getQuantidade() {
        return $this->quantidade;
    }

    /*----------------------------------------*/
    //Metodos de set dos atributos privados da classe
    function setVenda($venda) {
        $this->venda = $venda;
    }

    function setProduto($produto) {
        $this->produto = $produto;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }


}
