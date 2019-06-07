<?php

/*Classe que instancia objetos para uso do produto unitário */
class KitProdutosDTO {
    //Atributos privados da classe
    private $idkitprodutos;
    private $nome;
    private $descricao;
    private $quantidade;
    private $preco;
    private $precoCompra;
    private $disponibilidade;
    private $categoria;
    /*----------------------------*/
    //Metodos de get dos atributos privados da classe
    function getIdkitprodutos() {
        return $this->idkitprodutos;
    }

    function getNome() {
        return $this->nome;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getQuantidade() {
        return $this->quantidade;
    }
    
    function getPreco() {
        return $this->preco;
    }
    function getPrecoCompra() {
        return $this->precoCompra;
    }

        
    function getDisponibilidade() {
        return $this->disponibilidade;
    }

    function getCategoria() {
        return $this->categoria;
    }
    /*----------------------------------------*/
    //Metodos de set dos atributos privados da classe
    function setIdkitprodutos($idkitprodutos) {
        $this->idkitprodutos = $idkitprodutos;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    function setPreco($preco) {
        $this->preco = $preco;
    }
    function setPrecoCompra($precoCompra) {
        $this->precoCompra = $precoCompra;
    }

    
    function setDisponibilidade($disponibilidade) {
        $this->disponibilidade = $disponibilidade;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }
}
    

    



