<?php

/* Classe reservada para manipulação de dados do login */
//Conexão com a classe de conexão com o banco de dados
require_once 'Conexao.php';
class LoginDAO {
    //Metodo de autenticação de usuario
    public function Login(LoginDTO $LoginDTO){
        try {
            //Conexão com o banco de dados pela classe PDO
            $pdo =  Conexao::getinstance();
            //Comando em SQL para pesquisar os dados na tabela usuario
            $sql = "SELECT * FROM usuario WHERE usuario = ? AND senha = ?";
            //Prepara o sql para receber os binds
            $stmt = $pdo->prepare($sql);
            //Metodo que guarda o valor setado nos atributos usuario e senha
            $stmt->bindValue(1, $LoginDTO->getUsuario());
            $stmt->bindValue(2, $LoginDTO->getSenha());
            //Executa o SQL
            $stmt->execute();
            //Guarda em um array todos os dados da tabela
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            //Retorna o array com todos os dados da tabela
            return $usuario;
        } catch (PDOException $ex) {
            echo "".$ex;
        }
    }
}
