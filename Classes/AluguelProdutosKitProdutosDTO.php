<?php

/*Classe que instancia objetos para uso da relação entre aluguel e produtos a serem alugados */
class AluguelProdutosKitProdutosDTO {
    //Atributos privados da classe
    private $aluguel;
    private $produto;
    private $kitprodutos;
    private $quantidadeItem;


    /*----------------------------*/
    //Metodos de get dos atributos privados da classe
    function getAluguel() {
        return $this->aluguel;
    }

    function getProduto() {
        return $this->produto;
    }

    function getKitprodutos() {
        return $this->kitprodutos;
    }
    function getQuantidadeItem() {
        return $this->quantidadeItem;
    }

    /*----------------------------------------*/
    //Metodos de set dos atributos privados da classe
    function setAluguel($aluguel) {
        $this->aluguel = $aluguel;
    }

    function setProduto($produto) {
        $this->produto = $produto;
    }

    function setKitprodutos($kitprodutos) {
        $this->kitprodutos = $kitprodutos;
    }
    function setQuantidadeItem($quantidadeItem) {
        $this->quantidadeItem = $quantidadeItem;
    }



}
