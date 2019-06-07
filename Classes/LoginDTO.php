<?php

/* Classe reservada para atributos do login*/
class LoginDTO {
    //Atributos privados da classe
    private $idlogin;
    private $usuario;
    private $senha;
    
    //Metodos de get dos atributos
    function getIdlogin() {
        return $this->idlogin;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getSenha() {
        return $this->senha;
    }

    //Metodos de set dos atributos
    function setIdlogin($idlogin) {
        $this->idlogin = $idlogin;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }


}
