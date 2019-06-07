<?php

/*Classe que instancia objetos para uso do cliente*/
class ClienteDTO {
    //Atributos privados da classe
    private $idcliente;
    private $nome;
    private $identificador;
    private $tipo;
    private $telefone;
    private $email;
    private $endereco;
    /*----------------------------*/
    //Metodos de get dos atributos privados da classe
    function getIdcliente() {
        return $this->idcliente;
    }

    function getNome() {
        return $this->nome;
    }

    function getIdentificador() {
        return $this->identificador;
    }
    function getTipo() {
        return $this->tipo;
    }
    function getTelefone() {
        return $this->telefone;
    }

    function getEmail() {
        return $this->email;
    }

    function getEndereco() {
        return $this->endereco;
    }
    /*----------------------------------------*/
    //Metodos de set dos atributos privados da classe
    function setIdcliente($idcliente) {
        $this->idcliente = $idcliente;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }
    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

        
    function setIdentificador($identificador) {
        $this->identificador = $identificador;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }


}
