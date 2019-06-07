<?php

/* Classe reservada para atributos do salão */
class SalaoDTO {
    //Atributos privados da classe
    private $idsalao;
    private $nome;
    private $tel;
    private $cep;
    private $rua;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;
    private $status;


    /*----------------------------*/
    //Metodos de get dos atributos privados da classe
    function getIdsalao() {
        return $this->idsalao;
    }

    function getNome() {
        return $this->nome;
    }

    function getTel() {
        return $this->tel;
    }

    function getCep() {
        return $this->cep;
    }

    function getRua() {
        return $this->rua;
    }

    function getNumero() {
        return $this->numero;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getEstado() {
        return $this->estado;
    }
    function getStatus() {
        return $this->status;
    }

    /*----------------------------------------*/
    //Metodos de set dos atributos privados da classe
    function setIdsalao($idsalao) {
        $this->idsalao = $idsalao;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setTel($tel) {
        $this->tel = $tel;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setRua($rua) {
        $this->rua = $rua;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }
    function setStatus($status) {
        $this->status = $status;
    }



}
