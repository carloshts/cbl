<?php

/*Classe que instancia objetos para uso da relação entre aluguel e cliente */
class AluguelDTO {
    //Atributos privados da classe
    private $idaluguel;
    private $dataentrada;
    private $datasaida;
    private $status;
    private $cliente;
    private $usuario;
    /*----------------------------*/
    //Metodos de get dos atributos privados da classe
    function getIdaluguel() {
        return $this->idaluguel;
    }

    function getDataentrada() {
        return $this->dataentrada;
    }

    function getDatasaida() {
        return $this->datasaida;
    }

    function getStatus() {
        return $this->status;
    }

    function getCliente() {
        return $this->cliente;
    }
    function getUsuario() {
        return $this->usuario;
    }

    
    
    /*----------------------------------------*/
    //Metodos de set dos atributos privados da classe
    function setIdaluguel($idaluguel) {
        $this->idaluguel = $idaluguel;
    }

    function setDataentrada($dataentrada) {
        $this->dataentrada = $dataentrada;
    }

    function setDatasaida($datasaida) {
        $this->datasaida = $datasaida;
    }

        
    function setStatus($status) {
        $this->status = $status;
    }

    function setCliente($cliente) {
        $this->cliente = $cliente;
    }
    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }



}
