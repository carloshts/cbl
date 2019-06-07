<?php

/* Classe reservada para atributos da venda*/


class VendaDTO {
    //Atributos privados da classe
    private $idvenda;
    private $cliente;
    private $data;
    private $status;
    private $usuario;
    /*----------------------------*/
    //Metodos de get dos atributos privados da classe
    function getIdvenda() {
        return $this->idvenda;
    }

    function getCliente() {
        return $this->cliente;
    }

    function getData() {
        return $this->data;
    }

    function getStatus() {
        return $this->status;
    }
    function getUsuario() {
        return $this->usuario;
    }

        /*----------------------------------------*/
    //Metodos de set dos atributos privados da classe
    function setIdvenda($idvenda) {
        $this->idvenda = $idvenda;
    }

    function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setStatus($status) {
        $this->status = $status;
    }
    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }



}
