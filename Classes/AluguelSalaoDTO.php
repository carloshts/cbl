<?php

/*Classe que instancia objetos para uso dos aluguéis de salão */
class AluguelSalaoDTO {
    //Atributos privados da classe
    private $cliente;
    private $salao;
    private $datareserva;
    private $dataentrega;
    private $status;
    private $usuario;
    /*----------------------------*/
    //Metodos de get dos atributos privados da classe
    function getCliente() {
        return $this->cliente;
    }

    function getSalao() {
        return $this->salao;
    }

    function getDatareserva() {
        return $this->datareserva;
    }

    function getDataentrega() {
        return $this->dataentrega;
    }

    function getStatus() {
        return $this->status;
    }
    function getUsuario() {
        return $this->usuario;
    }

        /*----------------------------------------*/
    //Metodos de set dos atributos privados da classe
    function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    function setSalao($salao) {
        $this->salao = $salao;
    }

    function setDatareserva($datareserva) {
        $this->datareserva = $datareserva;
    }

    function setDataentrega($dataentrega) {
        $this->dataentrega = $dataentrega;
    }

    function setStatus($status) {
        $this->status = $status;
    }
    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }



}
