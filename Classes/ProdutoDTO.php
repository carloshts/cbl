<?php

/*Classe que instancia objetos para uso do produto unitário */
class ProdutoDTO {
    //Atributos privados da classe
    private $idproduto;
    private $nome;
    private $descricao;
    private $permissao;
    private $precoCompra;
    private $preco;
    private $quantidade;
    private $disponibilidade;
    private $categoria;
    private $kitprodutos;
    private $estoque;
    /*----------------------------*/
    //Metodos de get dos atributos privados da classe
    function getIdproduto() {
        return $this->idproduto;
    }

    function getNome() {
        return $this->nome;
    }

    function getDescricao() {
        return $this->descricao;
    }
    function getPermissao() {
        return $this->permissao;
    }

    function getPrecoCompra() {
        return $this->precoCompra;
    }

        function getPreco() {
        return $this->preco;
    }
    
    function getQuantidade() {
        return $this->quantidade;
    }

    function getDisponibilidade() {
        return $this->disponibilidade;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getKitprodutos() {
        return $this->kitprodutos;
    }
    
    function getEstoque() {
        return $this->estoque;
    }

    
    
    /*----------------------------------------*/
    //Metodos de set dos atributos privados da classe
    function setIdproduto($idproduto) {
        $this->idproduto = $idproduto;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    function setPermissao($permissao) {
        $this->permissao = $permissao;
    }
    function setPrecoCompra($precoCompra) {
        $this->precoCompra = $precoCompra;
    }

        
        function setPreco($preco) {
        $this->preco = $preco;
    }

    function setDisponibilidade($disponibilidade) {
        $this->disponibilidade = $disponibilidade;
    }
    
    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setKitprodutos($kitprodutos) {
        $this->kitprodutos = $kitprodutos;
    }
    
    function setEstoque($estoque) {
        $this->estoque = $estoque;
    }


}
