<?php

/*Classe que instancia objetos para uso do usuario*/
class UsuarioDTO {
    //Atributos privados da classe
    private $idusuario;
    private $usuario;
    private $senha;
    private $tipo;
    /*----------------------------*/
    //Metodos de get dos atributos privados da classe
    function getIdusuario() {
        return $this->idusuario;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getSenha() {
        return $this->senha;
    }

    function getTipo() {
        return $this->tipo;
    }
    /*----------------------------------------*/
    //Metodos de set dos atributos privados da classe
    function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }    
}
