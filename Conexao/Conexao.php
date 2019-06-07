<?php

/*Classe de conexão com o banco de dados
 */
abstract class Conexao {
    //Metodo construtor da classe
    function __construct() {
        
    }
    //metodo que pega a instancia do objeto da classe PDO[
    static function getinstance(){
        try {
            //Instanciando objeto da classe PDO
            $pdo = new PDO/*Conexão com o banco de dados*/("mysql:host=localhost;dbname=aluguel_produtos_festa","root","");
            //Retorna objeto instanciado na classe PDO
            return $pdo;
            
        } catch (PDOException $ex) {
            //Imprime erro caso não haja conexão com o banco de dados
            echo "".$ex;
        }
    }
}
