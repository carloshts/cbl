<?php

/*Classe que instancia objetos para uso das categorias */
class CategoriaDTO {
    //Atributos privados da classe
    private $idcategoria;
    private $categoria;
    
    /*----------------------------*/
    //Metodos de get dos atributos privados da classe
    function getIdcategoria() {
        return $this->idcategoria;
    }

    function getCategoria() {
        return $this->categoria;
    }
    /*----------------------------------------*/
    //Metodos de set dos atributos privados da classe
    function setIdcategoria($idcategoria) {
        $this->idcategoria = $idcategoria;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }


}
